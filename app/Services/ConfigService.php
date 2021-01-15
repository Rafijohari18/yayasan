<?php

namespace App\Services;

use App\Models\Config;
use App\Repositories\Interfaces\ConfigRepositoryInterface;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;


class ConfigService implements ConfigServiceInterface
{
    private $config;

    use UploadTrait;

    private $configRepository;

    public function __construct(Config $config , ConfigRepositoryInterface $configRepository)
    {
        $this->configRepository = $configRepository;
        $this->config = $config;

    }

    public function getConfig(int $gId)
    {
        return $this->configRepository->getNot($gId, 'name', ['b_default', 'm_ga_api']);
    }

    public function getBanner()
    {
        return $this->configRepository->getBy('name', 'b_default');
    }

    public function getFileAnalytics()
    {
        return $this->configRepository->getBy('name', 'm_ga_api');
    }

    public function getValue($value)
    {
        return $this->configRepository->getBy('name', $value)['value'];
    }

    public function update($name, $value)
    {
        return $this->configRepository->update($name, ['value' => $value]);
    }

    public function changeBanner($request)
    {
        $fileName = 'Banner-Default-'.Carbon::parse(now())->format('YmdHis').'.'.$request->file('b_default')->guessExtension();
        $request->file('b_default')->move(public_path('userfile/banner'), $fileName);
        
        $loc = public_path('userfile/banner/'.$request->oldbanner) ;
        File::delete($loc);
        
        return $this->configRepository->update('b_default', ['value' => $fileName]);
    }

    public function changeFileAnalytics($request)
    {
        $fileName = 'service-account-credentials.'.$request->m_ga_api->getClientOriginalExtension();
        $request->file('m_ga_api')->move(storage_path('app/analytics'), $fileName);
        
        return $this->configRepository->update('m_ga_api', ['value' => $fileName]);
    }

    /**Language */
    public function getAllLang()
    {
        return $this->configRepository->getAllLang();
    }

    public function getLang($request)
    {
        return $this->configRepository->getLang($request);
    }

    public function countLang($request)
    {
        return $this->configRepository->countLang($request);
    }

    public function getLangNot()
    {
        return $this->configRepository->getLangNot('lang', [config('app.fallback_locale')]);
    }

    public function createLang($request)
    {
        $config = $this->configRepository->createLang([
            'lang' => strtolower($request->lang),
            'name' => $request->name,
            'icon' => $request->icon,
            'status' => 1,
        ]);

        $path = resource_path('lang/'.strtolower($request->lang));
        File::makeDirectory($path, $mode = 0777, true, true);
        File::put($path.'/common.php', '<?php');

        return $config;
    }

    public function findLang(int $id)
    {
        return $this->configRepository->findLang($id);
    }

    public function updateLang($request, int $id)
    {
        return $this->configRepository->updateLang($id, [
            'lang' => strtolower($request->lang),
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
    }

    public function statusLang(int $id)
    {
        $lang = $this->findLang($id);

        return $this->configRepository->updateLang($id, [
            'status' => !$lang['status'],
        ]);
    }

    public function deleteLang(int $id)
    {
        $lang = $this->findLang($id);

        File::delete('common.php');
        File::deleteDirectory(resource_path('lang/'.$lang['lang']));

        $config = $this->configRepository->deleteLang($id);

        return $config;
    }

    /**visitor */
    public function visitor()
    {
        return $this->configRepository->visitor();
    }

    public function findVisitor($ip)
    {
        return $this->configRepository->findVisitor($ip);
    }

    public function graphicVisitor($year, $month)
    {
        return $this->configRepository->graphicVisitor($year, $month);
    }

    public function visitorToday()
    {
        return $this->configRepository->dateVisitor(Carbon::now()->format('Y-m-d'));
    }

    public function visitorWeek()
    {
        return $this->configRepository->dateVisitor([date('Y-m-d', strtotime('-7 day')), date('Y-m-d')]);
    }

    public function visitorMonth()
    {
        return $this->configRepository->dateVisitor(Carbon::now()->format('m'));
    }

    public function visitorYear()
    {
        return $this->configRepository->dateVisitor(Carbon::now()->format('Y'));
    }

    public function addVisitor($request)
    {
        if (config('addon.another.visitor') == true) {

            $checkIP = $request->ip();
            $checkUrl = URL::full();

            $visitor = $this->configRepository->findVisitorBy('ip_address', $checkIP)->where('access_page', $checkUrl)->count();
            if ($visitor == 0) {

                return $this->configRepository->createVisitor([
                    'access_page' => $checkUrl,
                    'ip_address' => $checkIP,
                    'access_hits' => 1,
                    'access_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'last_access' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

            } else {

                $visit = $this->configRepository->findVisitorBy('ip_address', $checkIP)->where('access_page', $checkUrl)->first();
                return $this->configRepository->findVisitorBy('ip_address', $checkIP)->where('access_page', $checkUrl)->update([
                    'access_hits' => $visit->access_hits + 1,
                    'last_access' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }



    // end

    public function get()
    {
        $query = $this->config->query();

        $result = $query->get();

        return $result;
    }

    public function updateConfig($key, $value)
    {
        try {
            //code...
            // dd($key, $value);
            $query = $this->config->query();
    
            $result = $query->where('name', $key)->update(['value' => $value]);
    
            return $result;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function storeTingkat($request)
    {
        foreach($request->tingkat as $key => $name){
            $insert_data[] = array(
               'group_by'      => '2',
               'name'          =>  $name,
               'lable'         => 'Tingkat Penyakit',
               'value'         =>  $name,
           );
        }
        
        $this->config::insert($insert_data);
    }
}

