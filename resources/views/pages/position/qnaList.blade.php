<style>
    .mt-10 {
        margin-top: 20px;
    }
</style>
<div class="p-4">
    <h5 style="border-bottom: 1px solid #dbdbdb; padding-bottom: 10px; margin-bottom: 10px;">Add Question & Answer</h5>
    <form action="{{ url('save-questionAndAnswer') }}" method="get">
        <input type="hidden" name="position" value="{{ $position }}">
        <textarea class="tinymce-editor" name="questionandanswer">

            {{ $qna ?? '<h6>Question:</h6>
            <p>Answer:</p>' }}
            
        </textarea>
        <br>
        <button type="submit" class="btn btn-warning pull-right">Save Question And Answer</button>
    </form>
</div>


<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script> 
 tinymce.init({
    selector: 'textarea.tinymce-editor',
    height: window.innerHeight-180,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount', 'image'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
});
</script>