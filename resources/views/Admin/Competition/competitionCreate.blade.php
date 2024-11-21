{{-- @php
    use Carbon\Carbon;
    $defaultDate = Carbon::now();
    $formattedDate = app()->getLocale() == 'fa' ? \Verta::instance($defaultDate)->format('Y-m-d') : $defaultDate->format('Y-m-d');
@endphp --}}

@extends('layout.admin')

@section('content')

<section class="middle">
            
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="form-competitions">Form Competitions</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                
                    <form id="add-competition-form" action="{{ route('competition_insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                            @if ($lastNumber)
                            <div class="alert alert-success">
                                <p id="number_of_competiton"  style="font-size: 12px; font-weight:bold"></p>
                                <p style="font-size: 12px; font-weight:bold">{{$lastNumber}}</p>
                                
                            </div>
                             
                            @endif
                       
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Question"  id="description-of-competiotion" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Answer" id="description-of-answer"
                                name="answer"></textarea>
                        </div>


                        <button type="submit" id="sub" class="btn btn-theme btn-block btn-form ">Submit </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <canvas id="chart" style="display: none;"></canvas>
   
</section>


@endsection