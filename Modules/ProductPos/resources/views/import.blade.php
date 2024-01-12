@extends('productpos::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Import Product
            </div>
            <div class="float-end">
                <a href="{{ route('productpos.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Form-->
            <form class="form" action="#" method="post">
                <!--begin::Input group-->
                <div class="form-group row">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label text-lg-right">Upload Files:</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::Dropzone-->
                        <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_2">
                            <!--begin::Controls-->
                            <div class="dropzone-panel mb-lg-0 mb-2">
                                <a class="dropzone-select btn btn-sm btn-primary me-2">Attach files</a>
                                <a class="dropzone-upload btn btn-sm btn-light-primary me-2">Upload All</a>
                                <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
                            </div>
                            <!--end::Controls-->

                            <!--begin::Items-->
                            <div class="dropzone-items wm-200px">
                                <div class="dropzone-item" style="display:none">
                                    <!--begin::File-->
                                    <div class="dropzone-file">
                                        <div class="dropzone-filename" title="some_image_file_name.xls">
                                            <span data-dz-name>some_image_file_name.xls</span>
                                            <strong>(<span data-dz-size>340kb</span>)</strong>
                                        </div>

                                        <div class="dropzone-error" data-dz-errormessage></div>
                                    </div>
                                    <!--end::File-->

                                    <!--begin::Progress-->
                                    <div class="dropzone-progress">
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                                aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->

                                    <!--begin::Toolbar-->
                                    <div class="dropzone-toolbar">
                                        <span class="dropzone-start"><i class="bi bi-play-fill fs-3"></i></span>
                                        <span class="dropzone-cancel" data-dz-remove style="display: none;"><i
                                                class="bi bi-x fs-3"></i></span>
                                        <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Dropzone-->

                        <!--begin::Hint-->
                        <span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // set the dropzone container id
        var id = "#kt_dropzonejs_example_2";

        // set the preview element template
        var previewNode = $(id + " .dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parent(".dropzone-items").html();
        previewNode.remove();

        var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(file, message) {
                $(file.previewElement).addClass("dz-error");
                $('.dropzone-error').text(message.message);
            },
            success: function(file, response) {
                // Do what you want to do with your response
                // This return statement is necessary to remove progress bar after uploading.
                alert(response.message);
                window.location.reload();
            },
            method: "POST",
            url: "{{ route('tools-productpos.import') }}", // Set the url for your upload script location
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            acceptedFiles: ".xlsx",
            maxFilesize: 5, // Max filesize in MB
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id +
                " .dropzone-select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(id + " .dropzone-start").onclick = function() {
                myDropzone.enqueueFile(file);
            };
            $(document).find(id + " .dropzone-item").css("display", "");
            $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css("display", "inline-block");
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            $(this).find(id + " .progress-bar").css("width", progress + "%");
        });

        myDropzone.on("sending", function(file, xhr, formData) {
            // Show the total progress bar when upload starts
            $(id + " .progress-bar").css("opacity", "1");
            // And disable the start button
            file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("complete", function(progress) {
            var thisProgressBar = id + " .dz-complete";
            setTimeout(function() {
                $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " +
                    thisProgressBar + " .dropzone-start").css("opacity", "0");
            }, 300)

        });

        // Setup the buttons for all transfers
        document.querySelector(id + " .dropzone-upload").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };

        // Setup the button for remove all files
        document.querySelector(id + " .dropzone-remove-all").onclick = function() {
            $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css("display", "none");
            myDropzone.removeAllFiles(true);
        };

        // On all files completed upload
        myDropzone.on("queuecomplete", function(progress) {
            $(id + " .dropzone-upload").css("display", "none");
        });

        // On all files removed
        myDropzone.on("removedfile", function(file) {
            if (myDropzone.files.length < 1) {
                $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css("display", "none");
            }
        });
    </script>
@endpush
