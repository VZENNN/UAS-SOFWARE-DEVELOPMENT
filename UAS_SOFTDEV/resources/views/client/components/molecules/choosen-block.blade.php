<div class="shadow-lg hover:shadow-xl transition-all duration-300 p-4 d-flex gap-4 flex-md-row flex-column align-items-center text-md-start text-center rounded-4 border border-light">
    <div class="icon-container position-relative">
        <div class="icon-bg bg-{{$bg}} d-flex align-items-center justify-content-center">
            <i class="bi {{ $icon }} icon-size text-white"></i>
        </div>
    </div>
    <div class="content-wrapper">
        <h3 class="fw-bold mb-2">{{ $title }}</h3>
        <p class="text-secondary mb-0">{{ $desc }}</p>
    </div>
</div>

<style>
.icon-container {
    width: 110px;
    height: 110px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-bg {
    width: 90px;
    height: 90px;
    border-radius: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.hover\:shadow-xl:hover .icon-bg {
    transform: scale(1.05);
}

.icon-size {
    font-size: 2.2rem;
}

.rounded-4 {
    border-radius: 1rem;
}

.transition-all {
    transition: all 0.3s ease;
}

.duration-300 {
    transition-duration: 300ms;
}

.hover\:shadow-xl:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>