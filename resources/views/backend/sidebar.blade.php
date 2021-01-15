<ul class="metismenu list-unstyled" id="side-menu">
        

        <li>
            <a href="{{ route('home')}}" class="waves-effect">
                <i class="ti-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        

        <li class="menu-title">MODUL</li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ti-archive"></i>
                    <span> Data Master </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                
                    <li><a href="{{ route('pages.index') }}">Halaman</a></li>
                    <li><a href="{{ route('category.content.index') }}">Konten</a></li>
                    <li><a href="{{ route('slider.index') }}">Slider Konten</a></li>
                    <li><a href="{{ route('profil.alumni.index') }}">Profil Alumni</a></li>

                    <!-- <li><a href="{{ route('dosen.index') }}">Data Dosen</a></li> -->
                    <!-- <li><a href="{{ route('product.index') }}">Produk</a></li> -->
                                        
                </ul>
                
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ti-gallery"></i>
                    <span> Gallery </span>
                </a>
                
                <ul class="sub-menu" aria-expanded="false">
                
                    <li><a href="{{ route('gallery.album.index') }}">Photo</a></li>
                    <li><a href="{{ route('gallery.playlist.index') }}">Video</a></li>
                                    
                </ul>

               
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ti-user"></i>
                    <span> Pengelolaan User </span>
                </a>
                
                <ul class="sub-menu" aria-expanded="false">
                    <!-- <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                    <li><a href="{{ route('alumni.index') }}">Data Alumni</a></li>
                    <li><a href="{{ route('guru.index') }}">Data Guru</a></li> -->
                    
                    <li><a href="{{ route('users.index') }}">Data User</a></li>               
                </ul>
            </li>

            <li>
                <a href="{{ route('web-config') }}" class="waves-effect">
                <i class="ti-settings"></i>
                    <span>Konfigurasi Web</span>
                </a>
                
            </li>
    </ul>