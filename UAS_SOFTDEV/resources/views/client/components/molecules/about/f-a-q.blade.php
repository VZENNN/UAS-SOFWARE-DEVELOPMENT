@props(['faqs'])
<div class="faq py-md-5 py-2" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <h3 class="font-primary"><u>Pertanyaan yang Sering Diajukan</u></h3>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="accordion" id="accordionExample">
                    @foreach ($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button font-primary {{ $index != 0 ? 'collapsed' : '' }}"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}"
                                 class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                 aria-labelledby="heading{{ $index }}"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body font-secondary">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
