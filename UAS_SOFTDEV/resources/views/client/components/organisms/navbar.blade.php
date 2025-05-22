@prepend('css')
<style>
  .header {
    width: 100%;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 100;
    background-color: rgba(255, 255, 255, 0.98);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: all 0.3s ease;
  }

  .nav {
    height: 4.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1.5rem;
  }

  /* Logo section - left */
  .nav-left {
    display: flex;
    align-items: center;
  }

  .nav-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: transform 0.3s ease;
  }

  .nav-logo:hover {
    transform: scale(1.05);
  }

  .nav-logo img {
    width: 55px;
    height: 55px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }
  
  .nav-logo img:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  }

  /* Menu section - center */
  .nav-menu {
    display: flex;
    align-items: center;
    margin: 0 auto;
  }

  .nav-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 2rem;
  }

  .nav-link {
    color: #333;
    font-weight: 500;
    text-decoration: none;
    font-size: 0.95rem;
    letter-spacing: 0.05rem;
    transition: all 0.3s ease;
    position: relative;
    padding: 0.5rem 0;
  }

  .nav-link:after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #435ebe;
    transition: width 0.3s ease;
  }

  .nav-link:hover {
    color: #435ebe;
  }

  .nav-link:hover:after {
    width: 100%;
  }

  /* Right section - search & cart */
  .nav-right {
    display: flex;
    align-items: center;
  }

  /* Toggle button for mobile */
  .nav-toggle {
    display: inline-flex;
    font-size: 1.25rem;
    cursor: pointer;
    color: #333;
    background: transparent;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
    display: none;
  }

  .nav-toggle:hover {
    background: rgba(0, 0, 0, 0.05);
  }

  .nav-toggle i {
    font-size: 24px;
  }

  /* Cart styling */
  .cart {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 1rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    transition: all 0.3s ease;
  }

  .cart:hover {
    background-color: rgba(0, 0, 0, 0.05);
  }

  .cart .bi-cart2 {
    font-size: 22px;
    color: #333;
  }

  .cart .count {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    min-width: 18px;
    height: 18px;
    font-size: 11px;
    font-weight: 600;
    border-radius: 50%;
    background: #435ebe;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
  }

  /* Search styling */
  .search {
    --easing: cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    border-radius: 50px;
    border: 2px solid transparent;
    display: flex;
    align-items: center;
    transition: all 0.3s var(--easing);
  }

  .search:focus-within {
    border-color: #435ebe;
    box-shadow: 0 0 0 4px rgba(67, 94, 190, 0.1);
  }

  .search__input {
    background: transparent;
    border: none;
    color: #333;
    font-size: 0.95rem;
    opacity: 0;
    outline: none;
    padding: 0;
    transition: all 0.3s var(--easing);
    width: 0;
  }

  .search:focus-within .search__input {
    opacity: 1;
    padding: 0.5rem 2.5rem 0.5rem 1rem;
    width: 200px;
  }

  .search__icon-container {
    height: 40px;
    width: 40px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
  }

  .search__icon-container:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }

  .search__label,
  .search__submit {
    color: #333;
    cursor: pointer;
    position: absolute;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .search__label svg,
  .search__submit svg {
    height: 20px;
    width: 20px;
  }

  .search__submit {
    background: none;
    border: none;
    outline: none;
    display: none;
  }

  .search:focus-within .search__label {
    opacity: 0;
  }

  .search:focus-within .search__submit {
    display: flex;
  }

  /* Mobile styles */
  @media screen and (max-width: 991px) {
    .nav {
      padding: 0 1rem;
    }
    
    .nav-toggle {
      display: flex;
    }
    
    .nav-menu {
      position: fixed;
      background-color: white;
      width: 80%;
      height: 100vh;
      top: 0;
      left: -100%;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      z-index: 100;
      padding: 4rem 1.5rem 2rem;
      transition: 0.3s ease;
      overflow-y: auto;
      display: block;
      margin: 0;
    }

    .nav-list {
      flex-direction: column;
      gap: 1.5rem;
    }

    .nav-link {
      font-size: 1.1rem;
      display: block;
      padding: 0.5rem 0;
    }

    .nav-close {
      position: absolute;
      top: 1rem;
      right: 1.25rem;
      font-size: 1.5rem;
      cursor: pointer;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .nav-close:hover {
      background-color: rgba(0, 0, 0, 0.05);
    }

    .show-menu {
      left: 0;
    }
    
    .search:focus-within .search__input {
      width: 150px;
    }
  }

  /* Animation for menu reveal */
  .show-menu {
    animation: slideIn 0.3s ease forwards;
  }

  @keyframes slideIn {
    from {
      left: -100%;
      opacity: 0;
    }
    to {
      left: 0;
      opacity: 1;
    }
  }

  /* Adding overlay when menu is open */
  .menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 99;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
  }

  .menu-overlay.active {
    opacity: 1;
    visibility: visible;
  }
</style>
@endprepend

<!-- Menu overlay for mobile -->
<div class="menu-overlay" id="menu-overlay"></div>

<header class="header" id="header">
  <nav class="nav container">
    <!-- Left Section - Logo -->
    <div class="nav-left">
      <a href="/" class="nav-logo" id="logo">
        <img src="{{ asset('shop/'.$path) }}" alt="Shop Logo">
      </a>
    </div>
    
    <div class="nav-toggle" id="nav-toggle">
      <i class="bi bi-list"></i>
    </div>
    
    <div class="nav-menu" id="nav-menu">
      <x-molecules.navbar.menu />
      <div class="nav-close" id="nav-close">
        {{-- <i class="bi bi-x"></i> --}}
      </div>
    </div>
    
    <div class="nav-right">
      <x-molecules.navbar.search-bar/>
      
    </div>
  </nav>
</header>

@prepend('js')
<script>
  const navMenu = document.getElementById("nav-menu");
  const navToggle = document.getElementById("nav-toggle");
  const navClose = document.getElementById("nav-close");
  const logo = document.getElementById("logo");
  const menuOverlay = document.getElementById("menu-overlay");

  if (navToggle) {
    navToggle.addEventListener("click", () => {
      navMenu.classList.add("show-menu");
      menuOverlay.classList.add("active");
      document.body.style.overflow = "hidden"; 
    });
  }

  if (navClose) {
    navClose.addEventListener("click", () => {
      navMenu.classList.remove("show-menu");
      menuOverlay.classList.remove("active");
      document.body.style.overflow = ""; 
    });
  }

  if (menuOverlay) {
    menuOverlay.addEventListener("click", () => {
      navMenu.classList.remove("show-menu");
      menuOverlay.classList.remove("active");
      document.body.style.overflow = "";
    });
  }

  window.addEventListener('scroll', () => {
    const header = document.getElementById('header');
    if (window.scrollY > 50) {
      header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.08)';
    } else {
      header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
    }
  });
</script>
@endprepend