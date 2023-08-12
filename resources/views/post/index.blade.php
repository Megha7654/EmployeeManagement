<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body onload="getTableData()">

<div class="container mt-3">
  <h2>Basic Card</h2>
  <div class="card">
    <div class="card-body">
    <form  method="POST" id="post" >
        
    <div class="mb-3 mt-3">
    <label for="email" class="form-label">Post Title:</label>
    <input type="text" class="form-control" id="title" placeholder="Enter Name" name="postname" required>
  </div>
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Description:</label>
    <input type="text" class="form-control" id="desc" placeholder="Enter email" name="description" required>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Author:</label>
    <input type="text" class="form-control" id="author" placeholder="Enter password" name="password" required>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </div>
  </div>
</div>
<table class ="table table-borderd">
    <thead> 
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
        </tr>
    </thead>
    <tbody id="tdata">
    </tbody>

</table>
<script>
  function getTableData(){
    console.log("here");
      $.ajax({
        'method':'GET',
        'url':'/post/1',
        'success':function(res){
            //alert(data);
            console.log(res.data);
            var result="";
            $.each( res.data, function( key, value ) {
                //alert( key + ": " + value.title );
                result+='<tr><td>'+value.title+'</td><td>'+value.desc+'</td><td>'+value.author+'</td></tr>';
        });
        $("#tdata").html(result);

        }
      })
  }  
$("form").submit(function(event){
    event.preventDefault()

  var formObj={
    'title':$("#title").val(),
    'desc':$("#desc").val(),
    'author':$("#author").val(),
    '_token':'{{csrf_token()}}'
  }
  $.ajax({
    'method':"POST",
    'url':'/post',
    'data':formObj,
    'success':function(data){
        getTableData();
    }
  });
});

</script>
</body>
</html>
