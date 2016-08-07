window.Dropzone = require('dropzone');

// reference: http://stackoverflow.com/questions/34526851/upload-files-to-amazon-s3-with-dropzone-js-issue
Dropzone.options.dropzoneCustom = {
    paramName: "file",
    maxFilesize: 50,
    method: 'put',
    acceptedFiles: 'image/*,.mp4',
    //autoQueue: false,
    //autoProcessQueue: false,
    accept(file, done) {

        var params = {
          fileName: file.name,
        };
   
        $.post('/files/sign', params).done(function(data) {
              
          file.signedRequest = data.signedRequest;
          file.finalURL = data.downloadUrl;
          
          done();
        }).fail(function() {
          return done('Failed to receive an upload url');
        });
    },
    sending(file, xhr) {

        var _send = xhr.send;

        xhr.send = function() {
            _send.call(xhr, file);
        }
  
    },
    processing(file) {
        this.options.url = file.signedRequest;
    }
};
