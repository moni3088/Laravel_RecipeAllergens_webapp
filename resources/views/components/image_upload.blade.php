<div class="image_upload">

    <input type="file" accept="image/*" style="display: none;" onchange="loadFile(event)">
    <img class="image_preview" src="{!! asset($placeholder) !!}"
         style="height: 200px; width: 200px;"/>

    <style>

        .image_preview {
            transition: .5s ease;
        }

        .image_upload:hover .image_preview {
            opacity: 0.3;
        }

    </style>

    <script>
        var loadFile = function (event) {
            $('img.image_preview').attr("src", URL.createObjectURL(event.target.files[0]));
        };

        $('img.image_preview').click(function () {
            $('input[type="file"]').click();
        });
    </script>

</div>
