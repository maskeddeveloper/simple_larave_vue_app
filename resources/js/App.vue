<template>
  <div class="notesAppContainer container">
    <div class="notesForm">
      <div class="title m-b-md">Notes</div>
      <div
        class="alert alert-danger"
        role="alert"
        v-bind:class="{ hidden: hasError }"
      >
        All fields are required!
      </div>
      <div class="form-group">
        <label for="title">Title</label>
        <input
          type="text"
          class="form-control"
          id="title"
          required
          placeholder="Title"
          name="title"
          v-model="newNote.title"
        />
      </div>

      <div class="form-group">
        <label for="note">Note</label>
        <input
          type="text"
          class="form-control"
          id="note"
          required
          placeholder="Note"
          name="note"
          v-model="newNote.note"
        />
      </div>

      <button class="btn btn-primary" @click.prevent="createNote()">
        Add Note
      </button>
    </div>
    <br /><br />
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
          <tr v-for="note in notes" v-bind:key="note.id">
            <th scope="row">@{{ note.id }}</th>
            <td>@{{ note.title }}</td>
            <td>@{{ note.note }}</td>

            <td
              @click="setVal(note.id, note.title, note.note)"

              class="btn btn-info btn-lg"
              data-toggle="modal"
              data-target="#myModal"
            >
              <i class="fa fa-pencil"></i>
            </td>
            <td @click.prevent="deleteNote(note)" class="btn btn-danger">
              <i class="fa fa-trash"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-body">
        <input
          type="hidden"
          disabled
          class="form-control"
          id="e_id"
          name="id"
          required
          :value="this.e_id"
        />
        Title:
        <input
          type="text"
          class="form-control"
          id="e_title"
          name="title"
          required
          :value="this.e_title"
        />
        Note:
        <input
          type="text"
          class="form-control"
          id="e_note"
          name="note"
          required
          :value="this.e_note"
        />
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="editNote()">
          Save changes
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: {
    newNote: { title: "", note: "" },
    hasError: true,
    notes: [],
    e_id: "",
    e_title: "",
    e_note: "",
  },
  mounted: function mounted() {
    this.getNotes();
  },
  methods: {
    getNotes: function getNotes() {
      var _this = this;
      axios
        .get("/getNotes")
        .then(function (response) {
          _this.notes = response.data;
        })
        .catch((error) => {
          console.log("Get All: " + error);
        });
    },
    createNote: function createNote() {
      var input = this.newNote;
      var _this = this;
      if (input["title"] == "" || input["note"] == "") {
        this.hasError = false;
      } else {
        this.hasError = true;
        axios
          .post("/storeNote", input)
          .then(function (response) {
            _this.newCar = { title: "", note: "" };
            _this.getNotes();
          })
          .catch((error) => {
            console.log("Insert: " + error);
          });
      }
    },
    deleteNote: function deleteNote(note) {
      var _this = this;
      axios
        .post("/deleteNote/" + note.id)
        .then(function (response) {
          _this.getNotes();
        })
        .catch((error) => {
          console.log("Delete note: " + error);
        });
    },
    setVal(val_id, val_title, val_note) {
      this.e_id = val_id;
      this.e_title = val_title;
      this.e_note = val_note;
    },
    editNote: function () {
      var _this = this;
      var id_val_1 = document.getElementById("e_id");
      var title_val_1 = document.getElementById("e_title");
      var note_val_1 = document.getElementById("e_note");
      var model = document.getElementById("myModal").value;
      axios
        .post("/editNotes/" + id_val_1.value, {
          val_1: title_val_1.value,
          val_2: note_val_1.value,
        })
        .then((response) => {
          _this.getNotes();
        });
    },
  },
};
</script>
