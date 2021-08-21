<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{csrf_token()}}">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title> To Do List  !</title>
</head>
<body>
  <br>
  <div class="container">
  <div class="jumbotron">
    <h1 class="text-center text-dark"> To Do List </h1><br>
     <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> Add Item </button>
     <br>
     <br>
    @if($category)
  <table class="table table-dark">
    <tr>
     
      <th>Item Name</th>
    </tr>
     @foreach($category as  $row)
    <tr>
      <td class="ouritem" data-toggle="modal" data-target="#exampleModal" data-id={{$row->id}}>
        {{$row->name}}
      </td>
    </tr>
    
      @endforeach
    </tr>
    
  </table> 
@endif
  </div>

  </div>
       @if (Session::has('success'))
  <div class="alert alert-success" style="margin-top:0" role="alert">
    <center><strong>Success: </strong>{{ Session::get('success')}}</center>
  </div>
@endif
@if (count($errors) >0)
  <div class="alert alert-danger"style="margin-top:4.9em" role="alert">
    <strong>Errors:</strong>
    <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="title"> Add Item </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="addNew">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="{{route('store')}}" method="POST" id="form-action">
          @csrf
        <input type="text" name="name" placeholder="Write Your Item" id="additem" class="form-control" value="{{$row->name}}">

      </div>
      <div class="modal-footer">
        <button class="btn btn-info" id="addButton" name="button"> Add Item </button>
        <a href="{{URL::to('delete/')}}" type="button" style="display: none;" class="btn btn-danger" data-dismiss="modal2" id="delete" name="delete"> Delete </a>
        <a href="{{URL::to('edit/')}}" type="button" style="display: none;" class="btn btn-primary" id="savechanges" name="update"> Save changes </a>
          <button class="btn btn-primary" id="update-button">Update</button>
          </form>
       
      </div>
    </div>
  </div>
</div>


  

  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.ouritem').each(function(){
        $(this).click(function(event){
          var id = $(this).data('id');
          var txt = $(this).text();
          $('#title').text('Edit Item');
          var url = $("#delete").attr('href');
          var newUrl = url+'/'+id;

           var id = $(this).data('id');
           
          var editUrl = $("#savechanges").attr('href');
          var editUrlWithId = editUrl+'/'+id;
          $("#form-action").attr('action',editUrlWithId);
          $("#delete").attr('href',newUrl);
          $('#edit-item').val(txt);
          $('#additem').val(txt);
          $('#delete').show('400');
          $('#update-button').show('400');
          $('#addButton').hide('400');
        });

      });

      $('#addNew').click(function(event){
         
          $('#title').text('Add Item');
        
          $('#additem').val("");
          $('#delete').hide('400');
          $('#savechanges').hide('400');
          $('#addButton').show('400');
        });


    });


  </script>
</body>
</html>