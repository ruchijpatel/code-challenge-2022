<!DOCTYPE html>
<html>
   <head>
      <title>Country Listing</title>
      <meta name="csrf-token" content="{{ csrf_token() }}"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
      <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   </head>
   <body>
      <div class="container">
         <h1 class="mb-5 mt-5">Country Listing</h1>
         <table class="table table-bordered data-table table-striped">
            <thead class="thead-dark">
               <tr>
                  <th>Country Code</th>
                  <th>Country Name</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script type="text/javascript">
         $(function () {
           var table = $('.data-table').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ route('country.index') }}",
               columns: [
                   {
                        data: 'countryCode', 
                        name: 'countryCode',
                        render:  function ( data, type, row, meta ) {
                            return "<a href='/api/countryDetail/"+data+"'>"+data+"</a>";
                        }
                    },
                   {data: 'name', name: 'name'},
               ]
           });
         });
          
      </script>
   </body>
</html>