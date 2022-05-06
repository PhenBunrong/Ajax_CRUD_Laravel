<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Ajax CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <section style="padding-top:60px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Student List <button class="btn btn-success" data-toggle="modal" data-target="#studentModal">Add Student</button>
                        </div>
                        <div class="card-body">
                            <table id="studentTable" class="table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $row)
                                        <tr id="sid{{$row->id}}">
                                            <td>{{$row->firstname}}</td>
                                            <td>{{$row->lastname}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="editStudent({{$row->id}})" class="btn btn-info">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 {{-- Add Student Modal --}}
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="studentForm">
              @csrf
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name ">
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                </div>
                <button type="submit" class="btn btn-success">submit</button>
          </form>
        </div>
      </div>
    </div>
</div>

 {{-- Update Student Modal --}}
 <div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="e" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="e">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="studentEditForm">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname2" placeholder="First Name ">
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname2" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="email2" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone2" placeholder="Phone">
                </div>
                <button type="submit" class="btn btn-success">submit</button>
          </form>
        </div>
      </div>
    </div>
</div>

  <script>
      $("#studentForm").submit(function(e){
          e.preventDefault();

          let firstname = $("#firstname").val();
          let lastname = $("#lastname").val();
          let email = $("#email").val();
          let phone = $("#phone").val();
          let _token = $("input[name=_token]").val();

          $.ajax({
              type: "POST",
              url: "{{route('student.add')}}",
              data: {
                  firstname: firstname,
                  lastname: lastname,
                  email: email,
                  phone: phone,
                  _token: _token
              },
              success: function (res) {
                if(res){
                    $("#studentTable tbody").prepend('<tr><td>'+res.firstname+'</td><td>'+res.lastname+'</td><td>'+res.email+'</td><td>'+res.phone+'</td></tr>');
                    $("#studentForm")[0].reset();
                    $("#studentModal").modal('hide');
                }
              }
          });
      })
  </script>

  <script>
      function editStudent(id){
          $.get('/student/'+id, function(stud){
              $("#id").val(stud.id);
              $("#firstname2").val(stud.firstname);
              $("#lastname2").val(stud.lastname);
              $("#phone2").val(stud.phone);
              $("#email2").val(stud.email);
              $("#studentEditModal").modal('toggle');
          })
      }

      $("#studentEditForm").submit(function(e){
          e.preventDefault();
          let id = $("#id").val();
          let firstname = $("#firstname2").val();
          let lastname = $("#lastname2").val();
          let email = $("#email2").val();
          let phone = $("#phone2").val();
          let _token = $("input[name=_token]").val();

          $.ajax({
              type: "PUT",
              url: "{{route('student.update')}}",
              data: {
                    id:id,
                    firstname:firstname,
                    lastname:lastname,
                    email:email,
                    phone:phone,
                    _token:_token
              },
              success: function(res) {
                  $('#sid' + res.id +' td:nth-child(1)').text(res.firstname);
                  $('#sid' + res.id +' td:nth-child(2)').text(res.lastname);
                  $('#sid' + res.id +' td:nth-child(3)').text(res.email);
                  $('#sid' + res.id +' td:nth-child(4)').text(res.phone);
                  $("#studentEditModal").modal('toggle');
                  $("#studentEditForm")[0].reset();
              }
          });
      })
  </script>
</body>
</html>