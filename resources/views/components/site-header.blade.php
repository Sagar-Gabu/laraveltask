<header>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            
            <a class="navbar-brand" href="">
            myshop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('site.index')}}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.shop')}}">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">
                            Contact
                            <span class="badge bg-danger"></span>
                        </a>
                    </li>

                    
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @else
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                        
                    @endguest
                   
                </ul>
            </div>
        </div>
    </nav>
</header>
