@extends('layouts.app')

@section('content')
<div class="m-auto w-4/5 py-24">
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">CARS</h1>
    </div>

    <div class="">
        <a href="cars/create" 
            class="border-b-2 pb-2 border-dotted italic text-gray-500">
            Add a New car &rarr;
        </a>
    </div>

    <div class="w-5/6 py-10">
        @foreach ($cars as $car)
            <div class="m-auto">
                <div class="float-right">
                    <a href="cars/{{ $car->id }}/edit"
                        class="border-b-2 pb-2 border-dotted italic text-green-500">
                        Edit &rarr;
                    </a>

                    <form action="/cars/{{ $car->id }}" method="POST" class="pt-3">
                        @csrf
                        @method('delete')
                        <button type="submit" 
                            class="border-b-2 pb-2 border-dotted italic text-red-500">
                            Delete &rarr;
                        </button>
                    </form>

                    <a href="cars/{{ $car->id }}"
                        class="border-b-2 pb-2 border-dotted italic text-green-500">
                        View &rarr;
                    </a>

                </div>

               

            </div>
            <div class="m-auto">
                <span class="uppercase text-blue-500 font-bold text-xs italic">
                    {{--  Founded:2020  --}}
                    Founded:{{ $car->founded }}
                </span>

                <h2 class="text-gray-700 text-5xl">
                    {{--  Audi  --}}
                    <a href="/cars/{{ $car->id }}">
                        {{ $car->name }}
                    </a>
                </h2>

                <p class="text-lg text-gray-700 py-6">
                    {{--  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Reiciendis magni non, porro distinctio ab voluptates debitis
                    est animi voluptas et? Quae quis similique minus aliquid maiore
                    s nisi animi! Odio, doloremque!  --}}
                    {{ $car->description }}
                </p>

                <hr class="mt-4 mb-8">
            </div>
        @endforeach
    </div>
</div>
@endsection