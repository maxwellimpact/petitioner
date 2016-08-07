require('../modules/dropzone');

Vue.component('uploader', {
  
    props: ['files'],

    data() {
      return {
        //files: [],
      }
    },

    ready() {
        console.log('loaded uploader');

        var uploader = this;

        Dropzone.options.dropzoneCustom.success = function(file) {
          uploader.files.push(file);
          this.removeFile(file);
        };
    },
    
    methods: {}
});
