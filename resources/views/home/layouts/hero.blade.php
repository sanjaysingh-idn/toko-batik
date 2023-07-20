<div class="container mt-2">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-mdb-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($banner as $item)
            <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="{{ $item->id }}" class="active" aria-current="true" aria-label="Slide 1"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($banner as $item)
            <div class="carousel-item active">
                <img src="{{ asset('storage/'.$item->image) }}" class="d-block w-100" alt="Wild Landscape" />
                <div class="carousel-caption d-none d-md-block">
                    <p><strong>{{ $item->keterangan }}</strong></p>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>