@extends('layouts.app')

@section('content')
<div class="m-auto w-4/5 py-24">
    <div class="text-center">
        <h1 class="text-5xl uppercase bold"> {{ $cars->name }}</h1>

        <div class="text center">
            <img src="{{ asset('images/'. $cars->image_path) }}" alt="image"
            class="w-9/12 mb-8 shadow-xl">
        </div>

        <div class="py-10 text-center">
            
                
                <div class="m-auto">

                    {{--  <h2 class="text-gray-700 text-5xl"> --}}
                        {{--  Audi  --}}
                        {{--  {{ $cars->name }}  --}}
                    {{--  </h2>  --}}  

                    <span class="uppercase text-blue-500 font-bold text-xs italic">
                        {{--  Founded:2020  --}}
                        Founded:{{ $cars->founded }}
                    </span>
    
                    
    
                    <p class="text-lg text-gray-700 py-6">
                        {{--  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Reiciendis magni non, porro distinctio ab voluptates debitis
                        est animi voluptas et? Quae quis similique minus aliquid maiore
                        s nisi animi! Odio, doloremque!  --}}
                        {{ $cars->description }}
                    </p>
    
                    <hr class="mt-4 mb-8">
                </div>

                <ul>
                    {{--  printing models  --}}
                    <p class="text-lg  text-gray-700 py-3">
                        Models:
                    </p>

                    @forelse($cars->carModels as $model)
                        <li class="inline italic text-gray-600 px-1 py-6">
                            {{ $model['model_name'] }}
                        </li>
                    @empty
                        <p>no models found</p>
                    @endforelse
                </ul>
                <hr class="mt-4 mb-8">

                {{--  table for has many raltionships  --}}
                <table class="table-auto">
                    <tr class="bg-blue-100">
                        <th class="w-1/4 border-4 border-gray-500">
                            Model
                        </th>
                        <th class="w-1/4 border-4 border-gray-500">
                            Engines
                        </th>
                        <th class="w-1/4 border-4 border-gray-500">
                           Date
                        </th>
                    </tr>

                    @forelse($cars->carModels as $model)
                        <tr>
                            <td class="border-4 border-gray-500">
                                {{ $model->model_name }}
                            </td>
                            <td class="border-4 border-gray-500">
                                @foreach ($cars->engines as $engine)
                                     @if ($model->id == $engine->model_id)
                                         {{ $engine->engine_name }}
                                     @endif
                                @endforeach
                            </td>
                            <td class="border-4 border-gray-500">
                                {{ date('d-m-Y'),strtotime
                                ($cars->productionDate->created_at) }}
                            </td>
                        </tr>
                    @empty
                        <p>No car models found</p>
                    @endforelse

                </table>

                <p class="text-left">
                    Product Types:
                    @forelse ($cars->products as $product)
                        {{ $product->name }}
                    @empty
                        <p>
                            No car product found
                        </p>
                    @endforelse
                </p>
           
        </div>

    </div>

    
</div>
@endsection