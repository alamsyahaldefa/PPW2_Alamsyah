@extends('auth.layouts')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('gallery.create') }}" class="btn btn-success mb-2">Tambah Baru</a>
                    </div>
                    @if(count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="col-sm-2">
                                <div>
                                    <a href="{{$gallery->original_pict}}" data-lightbox="roadtrip" data-title="{{$gallery->description}}">
                                        <img class="example-image img-fluid mb-2" src="{{asset('storage/posts_image/'.$gallery->picture)}}" alt="image-1" />
                                    </a>
                                    <div>
                                        <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin dihapusss?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3>Tidak ada data.</h3>
                    @endif
                </div>
                <div class="d-flex">
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
