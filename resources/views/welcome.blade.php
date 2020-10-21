<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;

                justify-content: center;
                margin-left: 20%;
                margin-right: 20%;
            }
            .position-ref {
                position: relative;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

    </head>
    <body id="app">
        <div class="notesAppContainer">
            <div class="notesForm">
                <div class="title m-b-md">
                    Notes
                </div>
                <div class="alert alert-danger" role="alert" v-bind:class="{hidden: hasError}">
                    All fields are required!
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" required placeholder="Title" name="title" v-model="newNote.Title">
                </div>

                <div class="form-group">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" required placeholder="Note" name="note" v-model="newNote.note">
                </div>

                <button class="btn btn-primary" @click.prevent="createNote()">
                    Add Note
                </button>
            </div>
            <div class="noteData">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Note</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for ="note in notes">
                        <th scope="row">@{{note.id}}</th>
                        <td>@{{note.title}}</td>
                        <td>@{{note.note}}</td>

                        <td @click="setVal(car.id, note.title, note.note)"  class="btn btn-info" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>
                        </td>
                        <td  @click.prevent="deleteNote(note)" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Modal -->
   <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-body">
        <input type="hidden" disabled class="form-control" id="e_id" name="id" required :value="this.e_id">
            Title: <input type="text" class="form-control" id="e_title" name="title" required :value="this.e_title">
            Note: <input type="text" class="form-control" id="e_note" name="note" required  :value="this.e_note">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="editNote()">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
