# php-helpers
Helpers that will make your life easier on your daily development 

Image uploader

upload_multiple and upload functions accepts 3 parameters
first and second is required and the third one is optional.

//example of uploading multiple images
upload_multiple('images' , 'path/to/uploads', 'MULTI-');
the first parameter is the global $_FILES name , second is path where the images
will be uploaded third one is the prefix name of new uploaded files.
