@extends('frontend.layout.master')
@section('title')
    Flight
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Style for the decrement button */
        .increment-decrement button:nth-child(1) {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px 0 0 4px;
            cursor: pointer;
        }

        /* Style for the input field */
        .increment-decrement input[type="number"] {
            width: 40px;
            text-align: center;
        }

        /* Style for the increment button */
        .increment-decrement button:nth-child(3) {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <section id="chart">
        <div class="container">
            <div class="row">
                <form id="search" action="{{ route('flightSearch') }}" method="POST">
                    @csrf
                    <div class="chart_1 clearfix">
                        <div class="book col-sm-6">
                            <div class="col-sm-6 space_left book_1">
                                <p>FROM</p>
                                <select name="from" id="from" class="form-control input-lg">
                                    <option>Select</option>
                                    @foreach ($flightFrom as $item)
                                        <option value="{{ $item->from }}">{{ $item->from }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 space_left  book_1">
                                <p>TO</p>
                                <select name="to" id="to" class="form-control input-lg">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4  journey">
                            <p>Journey Date</p>
                            <div class="row_1 clearfix">
                                <div class="col-sm-6 space_left">
                                    <input class="form-control" placeholder="Type Minimum 3 letters" name="flight_date"
                                        type="date">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 more_2">
                            <div class="col-sm-4 space_left search_inner"><a href="#"
                                    onclick="document.getElementById('search').submit();">Search</a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="fare">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 box" style="margin-bottom: 3px">
                    <div class="col-sm-2 box_1">
                        <p>Airways</p>
                    </div>
                    <div class="col-sm-2 box_1">
                        <p>Departure</p>
                    </div>
                    <div class="col-sm-2 box_1">
                        <p>Flight Date</p>
                    </div>
                    <div class="col-sm-2 box_1">
                        <p>Sits</p>
                    </div>
                    <div class="col-sm-2 box_1">
                        <p>Price</p>
                    </div>
                    <div class="col-sm-2 ">

                    </div>
                </div>

                @if (!empty($flights) && $flights->count() > 0)
                    @foreach ($flights as $flight)
                        <?php $flight->departure_time = new DateTime($flight->departure_time); ?>
                        <div class="col-sm-12 box_2" style="margin-bottom: 10px">
                            <div class="col-sm-2 box_2_inner">
                                <div class="col-sm-2 box_2_inner_icon"><i class="fa fa-plane"></i></div>
                                <div class="col-sm-10">
                                    <h5>{{ $flight->airlines_name }}</h5>
                                    <p>{{ $flight->airlines_model }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2 box_2_inner_1">
                                <h3>{{ $flight->departure_time->format('h:i A') }}</h3>
                            </div>
                            <div class="col-sm-2 box_2_inner_1">
                                <h3>{{ \Carbon\Carbon::parse($flight->flight_date)->format('d-m-Y') }}</h3>
                            </div>
                            <div class="col-sm-2 box_2_inner_1">
                                <h4>{{ $flight->available_sit }} Avaliable</h4>
                            </div>
                            <div class="col-sm-2 box_2_inner_1">
                                <h4>৳ {{ $flight->price }} /person</h4>
                            </div>
                            <div class="col-sm-2 box_2_inner_3">
                                <h4 class="text-center text-bold"><span>৳</span> <span
                                        id="totalPrice{{ $loop->index }}">{{ $flight->price }}</span></h4>
                                <form class="myForm" action="{{ route('payment') }}" method="POST">
                                    @csrf
                                    <div class="increment-decrement text-center">
                                        <input type="hidden" name="module_id" value="2">
                                        <input type="hidden" name="package_id" value="{{ $flight->id }}">
                                        <button type="button" class="btn btn-danger" onclick="decrementValue(this)"
                                            data-price="{{ $flight->price }}" data-index="{{ $loop->index }}">-</button>
                                        <input type="number" name="number_of_member" class="number_of_member"
                                            value="1" oninput="calculateTotalPrice(this)" disabled>
                                        <button type="button" class="btn btn-success" onclick="incrementValue(this)"
                                            data-price="{{ $flight->price }}" data-index="{{ $loop->index }}">+</button>
                                    </div>
                                    <p class="text-center">
                                        @auth
                                            <a href="#" onclick="submitForm({{ $loop->index }});">Book</a>
                                        @endauth
                                        @guest
                                        <h4 style="color: red">To booked the package you must login first</h4>
                                    @endguest

                                    </p>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
@push('user_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#from').change(function() {
                var from = $(this).val();
                $.ajax({
                    url: '/get-to-data',
                    type: 'GET',
                    data: {
                        'from': from
                    },
                    success: function(response) {
                        var toSelect = $('#to');
                        toSelect.find('option').not(':first').remove();
                        $.each(response, function(index, value) {
                            toSelect.append('<option value="' + value.to + '">' + value
                                .to + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        // handle error
                    }
                });
            });
        });
    </script>
    <script>
        function incrementValue(element) {
            var price = element.getAttribute('data-price');
            var index = element.getAttribute('data-index');
            var inputElement = document.getElementsByClassName('number_of_member')[index];
            inputElement.value = parseInt(inputElement.value) + 1;
            calculateTotalPrice(inputElement, price, index);
        }

        function decrementValue(element) {
            var price = element.getAttribute('data-price');
            var index = element.getAttribute('data-index');
            var inputElement = document.getElementsByClassName('number_of_member')[index];
            if (inputElement.value > 1) {
                inputElement.value = parseInt(inputElement.value) - 1;
                calculateTotalPrice(inputElement, price, index);
            }
        }

        function calculateTotalPrice(inputElement, price, index) {
            var priceElement = document.getElementById('totalPrice' + index);
            var totalPrice = parseFloat(inputElement.value) * price;
            priceElement.innerText = totalPrice;
        }

        function updateMemberCount(inputElement) {
            var memberCountElement = document.getElementById('memberCount');
            memberCountElement.innerText = inputElement.value;
        }

        // function submitForm() {
        //     var memberCount = 0;
        //     document.getElementById('memberCount').value = memberCount;
        //     document.getElementById('number_of_member').removeAttribute('disabled');
        //     document.getElementById('myForm').submit();
        // }

        function submitForm(index) {
            var forms = document.getElementsByClassName('myForm');
            var form = forms[index];
            form.getElementsByClassName('number_of_member')[0].removeAttribute('disabled');
            form.submit();
        }
    </script>
@endpush
