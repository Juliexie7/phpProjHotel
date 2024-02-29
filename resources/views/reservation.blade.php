@extends('layouts.main')
@section('content')
<?php

            $apiKey = '8ad2bceae928ba5ec481740f3c0710e1';
            $cityName = $hotel->city;
            $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . 
                    $cityName . 
                    '&appid=' . 
                    $apiKey;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($result,true);
            
            if($response['cod'] != 200){
                echo 'Error API returned status code' . $response['cod'] . "<br>";
                echo 'Message: ' . $response['message'] . "<br>";
            }
            $temp = round($response['main']['temp'] - 273.15, 0);
            $iconURL = "https://openweathermap.org/img/wn/".$response['weather'][0]['icon']."@2x.png";
            $desc = $response['weather'][0]['description'];
        ?>
<div class="container" style="margin-top: 70px; margin-bottom: 140px">
<br>

    <div class="d-flex align-items-end">
        <!-- <p class="mx-3 mb-2">LocalCast: </p> -->
        <h5 class="mx-2 mb-2"><?php echo $response['name'].", ".$response['sys']['country'] ?></h5>
        <img src=<?php echo $iconURL ?> alt="weather" title="<?php echo $desc ?>" style="max-height: 60px;">        
        <p class="mx-2 mb-2"><?php echo $temp ?>°C</p>
        <br>
    </div>
    <br><br>
    
    <div class="container px-5">
        <form method="post" action="{{ route('store',$hotel->hotel_id )}}">
        {{csrf_field()}}

            <h5>Choose a room</h5>
            <div class="row mb-4">
                <div class="col">
                <div class="form-outline">
                    <input type="date" id="checkin" name="checkin" class="form-control" />
                    <label class="form-label" for="checkin">Check-in date</label>
                </div>
                </div>
                <div class="col">
                <div class="form-outline">
                    <input type="date" id="checkout" name="checkout" class="form-control" onchange="showAvailable();"/>
                    <label class="form-label" for="checkout">Check-out date</label>
                </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">             	
                @if ($errors->has('checkin'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('checkin') }}
                    </div>
                @endif
                
                </div>
                <div class="col">
                @if ($errors->has('checkout'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('checkout') }}
                    </div>
                @endif
                </div>
            </div>

            <!-- radio -->
            <div class="form-check">
            <input class="form-check-input" type="radio" name="roomtype" id="room1" value="1" checked/>
            <label class="form-check-label" for="room1"> 1 King Bed Standard </label>
            <span class="ms-5 h5" id="room1Available"></span>
            <span class="ms-1 h5" id="room1text">Choose the dates to check room availability</span>
            <button type="button" class="btn btn-link ms-5" data-mdb-toggle="modal" data-mdb-target="#Modal1">Details</button>

            <!-- Modal -->
            <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="ModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel1">1 King Bed Standard</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                    $line = "";
                    if (file_exists(dirname(__DIR__, 3)."/public/Kingbed.txt")) {
                        $file = fopen(dirname(__DIR__, 3)."/public/Kingbed.txt", "r");
                        while(!feof($file)) {
                            $line = fgets($file);
                            echo "<p>$line</p>";
                        }
                        fclose($file); 
                    }
                ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" name="roomtype" id="room2" value="2" />
            <label class="form-check-label" for="room2"> 1 King Bed Balcony Studio </label>
            <span class="ms-1 h5" id="room2Available"></span>
            <span class="ms-1 h5" id="room2text">Choose the dates to check room availability</span>
            <button type="button" class="btn btn-link ms-5" data-mdb-toggle="modal" data-mdb-target="#Modal2">Details</button>

            <!-- Modal -->
            <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="ModalLabel2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel2">1 King Bed Balcony Studio</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                    $line = "";
                    if (file_exists(dirname(__DIR__, 3)."/public/KingBalcony.txt")) {
                        $file = fopen(dirname(__DIR__, 3)."/public/KingBalcony.txt", "r");
                        while(!feof($file)) {
                            $line = fgets($file);
                            echo "<p>$line</p>";
                        }
                        fclose($file); 
                    }
                ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" name="roomtype" id="room3" value="3" />
            <label class="form-check-label me-2" for="room3"> 2 Queens Standard </label>
            <span class="ms-5 h5" id="room3Available"></span>
            <span class="ms-1 h5" id="room3text">Choose the dates to check room availability</span>            
            <button type="button" class="btn btn-link ms-5" data-mdb-toggle="modal" data-mdb-target="#Modal3">Details</button>

            <!-- Modal -->
            <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel3" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel3">2 Queens Standard</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                    $line = "";
                    if (file_exists(dirname(__DIR__, 3)."/public/Queenbed.txt")) {
                        $file = fopen(dirname(__DIR__, 3)."/public/Queenbed.txt", "r");
                        while(!feof($file)) {
                            $line = fgets($file);
                            echo "<p>$line</p>";
                        }
                        fclose($file); 
                    }
                ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            </div>
            <span class="h5 text-danger"></span>

            <br><hr>
            <h5>Personnal information</h5>

            <div class="form-outline my-4">
                <input type="text" id="name" name="name" class="form-control" />
                <label class="form-label" for="name">Name</label>
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email</label>
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- Number input -->
            <div class="form-outline mb-4">
                <input type="number" id="phone" name="phone" class="form-control" />
                <label class="form-label" for="phone">Phone</label>
            </div>
            @if ($errors->has('phone'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('phone') }}
                </div>
            @endif

            <!-- Message input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="addInfo" name="addInfo" rows="4"></textarea>
                <label class="form-label" for="addInfo">Additional information</label>
            </div>
            @if ($errors->has('addInfo'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('addInfo') }}
                </div>
            @endif
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block" id="submitForm">Reserve</button>
        </form>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showAvailable() {
        var hotel_id = <?php echo $hotel->hotel_id ?>;
        const HOST =  "{{ url('/') }}"; 
        var checkin = document.getElementById("checkin").value;
        var checkout = document.getElementById("checkout").value;
        if (checkout !=="" && checkin !== "") {
            $.ajax({
            method: "get",
            url: `${HOST}/room/${hotel_id}/${checkin}/${checkout}`,
            })
            .done((response) => {
                if (response.length ===0 ) {
                    document.getElementById("room1Available").innerText = "";
                    document.getElementById("room2Available").innerText = "";
                    document.getElementById("room3Available").innerText = "";
                    document.getElementById("room1text").innerText = "Sold out";
                    document.getElementById("room2text").innerText = "Sold out";
                    document.getElementById("room3text").innerText = "Sold out";
                } else {
                        for (let index = 0; index < response.length; index++) {
                        const element = response[index];
                        switch (element.room_type_id) {
                            case 1:
                                document.getElementById("room1Available").innerText = element.available;
                                document.getElementById("room1text").innerText = "Available";
                                break;
                            case 2:
                                document.getElementById("room2Available").innerText = element.available;
                                document.getElementById("room2text").innerText = "Available";
                                break;
                            case 3:
                                document.getElementById("room3Available").innerText = element.available;
                                document.getElementById("room3text").innerText = "Available";
                        }
                    }
                }
            })
            .fail((xhrObj) => { 
                if (xhrObj && xhrObj.responseJSON && xhrObj.responseJSON.message)
                alert(xhrObj.responseJSON.message);
                if (xhrObj && xhrObj.responseText) {
                alert(xhrObj.responseText);
                }
          });
        } 
    }

    window.onload = function() {
        document.getElementById("submitForm").onclick = function(event) {
            checkroom(event);
        }
    };

    function checkroom(event) {
        var radios = document.getElementsByName('roomtype');
        var spans = document.getElementsByTagName('span');
        spans[6].innerText = ""; 
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].type === 'radio' && radios[i].checked && spans[i*2].innerText === "") {
                spans[6].innerText = "Please select an available room"; 
                event.preventDefault();
            }
        }
        // event.stopImmediatePropagation();
    }
</script>
@endsection