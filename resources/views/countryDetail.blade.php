<html lang="en">

<head>
      <title>Country Detail</title>
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   </head>

<body>
    <div class="container">
        <div class="row" style="padding-top: 5%;">
            <div class="col-md-12"><a href="/api/country">Back Country List</a></div>
            <div class="col-md-12"><h3 class="text-center">Country Details</h3></div>
            <div class="col-md-12"><h5> Name : {{ $data['commonName'] }}</h5></div>
            <div class="col-md-12"><h5> Region : {{ $data['region'] }}</h5></div>
            <div class="col-md-12"><h5> Code : {{ $data['countryCode'] }}</h5></div>
            <div class="col-md-12"><h5> No Countries Bordering : {{ count($data['borders']) }}</h5></div>
            <div class="col-md-12"><h5 class="">Total Hoiday : {{ $data['countryWeekend'] }}</h5></div>
        </div>
        <div class="row p-t-10">
            <div class="col-md-12">
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h4 class="text-center">Countries Bordering</h4>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Country Code</th>
                            <th>Country Name</th>
                            <th>Country region</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['borders'] as $border)
                            <tr>
                                <td>{{ $border['commonName'] }}</td>
                                <td>{{ $border['countryCode'] }}</td>
                                <td>{{ $border['region']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-7">
                <h4 class="text-center">Next 4 Holiday's</h4>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Local Name</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['HolidayList'] as $border)
                            <tr>
                                <td>{{ $border['date'] }}</td>
                                <td>{{ $border['localName'] }}</td>
                                <td>{{ $border['name']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
</html>