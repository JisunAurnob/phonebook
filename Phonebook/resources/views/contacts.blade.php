@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
@endpush
@section('title', 'Contacts')
@section('content')
    <div class="row justify-content-center">
        @foreach ($cars as $car)
        <div class="col-md-4">
            <div class="card car_card">
                <div id="card_img" class="card_image">
                    <img src="{{ asset($car->car_image) }}" class="img-fluid" alt="...">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">{{$car->make}} ({{$car->model}})</h4>
                        </div>
                        <div class="col-6">
                            <h6 class="card-title" style="float: right">$ {{$car->price}}</h6>
                        </div>
                    </div>
                    <p class="card-text">VIN: {{$car->vin}}</p>
                    <center><a href="/car/details/{{$car->id}}" class="btn btn-primary details_button">Details</a></center>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".card-body").click(function() {
                alert('you have clicked this');
            })
            // $("#report_type").change(function() {
            //     var value = $(this).val();
			// 		// console.log(value);
            //     $( "#typeValue" ).remove();
            //     if(value=="daily"){
            //         $('<div id="typeValue" class="col-md-5 form-group"><input type="date" class="form-control" id="daily_date" name="daily_date"></div>')
            //         .insertAfter('#report_type_div');
            //         $(function(){
            //         var dtToday = new Date();

            //         var month = dtToday.getMonth() + 1;
            //         var day = dtToday.getDate();
            //         var year = dtToday.getFullYear();

            //         if(month < 10)
            //             month = '0' + month.toString();
            //         if(day < 10)
            //             day = '0' + day.toString();

            //         var maxDate = year + '-' + month + '-' + day;    
            //         $('#daily_date').attr('max', maxDate);
            //         });
            //     }

            //     if(value=="monthly"){
            //         $('<div id="typeValue" class="col-md-5 form-group"><input type="month" class="form-control" id="month" name="month"></div>')
            //         .insertAfter('#report_type_div');  
            //         $(function(){
            //         var dtToday = new Date();

            //         var month = dtToday.getMonth() + 1;
            //         var year = dtToday.getFullYear();

            //         if(month < 10)
            //             month = '0' + month.toString();

            //         var maxDate = year + '-' + month;    
            //         $('#month').attr('max', maxDate);
            //         });
            //     }

            //     if(value=="yearly"){
            //         $('<div id="typeValue" class="col-md-5 form-group"><input type="number" class="form-control" id="year" name="year" min="2022" step="1" value="2022"></div>')
            //         .insertAfter('#report_type_div');  
            //         var year = new Date().getFullYear();
            //         console.log(year);
            //         $('#year').attr('max', year);
            //     }
            // });

        });
    </script>
    @endpush
@endsection
