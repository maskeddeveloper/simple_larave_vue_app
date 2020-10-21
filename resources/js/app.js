/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
const { default: Axios } = require('axios');
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('modal', {
    template: '#modal-template'
  })


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        newNote: {'title': '', 'note': ''},
        hasError: true,
        notes: [],
        e_id: '',
        e_title: '',
        e_note: '',
    },
    mounted: function mounted(){
        this.getNotes();
    },
    methods: {
        getNotes: function getNotes(){
            var _this = this;
            axios.get('/getNotes').then(function(response){
                _this.notes = response.data;
            }).catch(error=>{
                console.log("Get All: "+error);
            });
        },
        createNote: function createNote() {
            var input = this.newNote;
            var _this = this;
            if(input['title'] == '' || input['note'] == '') {
                this.hasError = false;
            }
            else {
                this.hasError= true;
                axios.post('/storeNote', input).then(function(response){
                    _this.newCar = {'title': '', 'note': ''}
                    _this.getNotes();
                }).catch(error=>{
                    console.log("Insert: "+error);
                });
            }
        },
        deleteNote: function deleteNote(note) {
            var _this = this;
            axios.post('/deleteNote/' + note.id).then(function(response){
                _this.getNotes();
            }).catch(error=>{
                console.log("Delete note: "+error);
            });
        },
        setVal(val_id, val_title, val_note) {
            this.e_id = val_id;
            this.e_title = val_title;
            this.e_note = val_note;
        },
        editNote: function(){
            var _this = this;
            var id_val_1 = document.getElementById('e_id');
            var title_val_1 = document.getElementById('e_title');
            var note_val_1 = document.getElementById('e_note');
            var model = document.getElementById('myModal').value;
             axios.post('/editNotes/' + id_val_1.value, {val_1: title_val_1.value, val_2: note_val_1.value})
               .then(response => {
                 _this.getNotes();
               });
     },
    }
});
