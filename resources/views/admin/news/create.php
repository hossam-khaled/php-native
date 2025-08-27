<?php
view('admin.layouts.header', ['title' => lang('admin.create')]);

$categories = db_get('categories', '');
?>
@php
//echo get_error();'
$title = get_error('title');
$image = get_error('image');
$description = get_error('description');
$content = get_error('content');
$category_id = get_error('category_id');
$user_id = get_error('user_id');
@endphp

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @if( any_errors() )
    <div class="alert alert-danger" role="alert">
        <ol>
            @foreach( all_errors() as $error)
            <li> @php echo $error @endphp </li>
            @endforeach
        </ol>
    </div>
    @php
    end_errors();
    @endphp
    @endif

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 d-flex justify-content-between w-100">
            {{lang('news.create')}}
            <a href="{{aurl('news')}}" class="btn btn-info">{{lang('admin.news')}}</a>
        </h1>
    </div>
    <form action="{{aurl('news/create')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="_method" value="post">
            <div class="mb-3 col-md-12">
                <label for="title" class="form-label">{{lang('news.title')}}</label>
                <input type="text" class="form-control <?= !empty($title) ? 'is-invalid' : '' ?>"
                    value="<?= old('title') ?>" id="title" name="title" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="image" class="form-label">{{lang('news.image')}}</label>
                <input type="file" class="form-control <?= !empty($image) ? 'is-invalid' : '' ?>"
                    value="<?= old('image') ?>" id="image" name="image">
            </div>
            <div class="mb-3  col-md-6">
                <label for="category_id" class="form-label">{{lang('news.category_id')}}</label>
                <?php //var_dump($categories['query']); die; 
                ?>
                <select class="form-select <?= !empty($category_id) ? 'is-invalid' : '' ?>" id="category_id" name="category_id" required>
                    <option disabled selected value="">{{ lang('admin.choose') }}</option>
                    <?php while ($category = mysqli_fetch_assoc($categories['query'])): ?>
                        <option value="{{$category['id']}}" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                            {{$category['name']}}
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3  col-md-12">
                <label for="description" class="form-label">{{lang('news.description')}}</label>
                <textarea class="form-control <?= !empty($description) ? 'is-invalid' : '' ?>" id="description"
                    name="description" rows="3"><?= old('description') ?></textarea>
            </div>
            <div class="mb-3 c5l-md-12">
                <label for="content" class="form-label">{{lang('news.content')}}</label>
                <textarea class="form-control <?= !empty($content) ? 'is-invalid' : '' ?>" id="content" name="content"
                    rows="5"><?= old('content') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{lang('news.create')}}</button>

        </div>
    </form>
</main>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/46.0.2/ckeditor5-premium-features.css" />
<script src="https://cdn.ckeditor.com/ckeditor5-premium-features/46.0.2/ckeditor5-premium-features.umd.js"></script>

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script> -->

<script type="module">
    // const LICENSE_KEY = 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3ODc3ODg3OTksImp0aSI6IjcxMjAyMzZiLWExYjctNGM0OS05MDYyLTJkZDZjMjZjZTgzMiIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIiwiRTJQIiwiRTJXIl0sInZjIjoiZmM5NDQyYmUifQ.L6eijLFQH8XRxZ3tfEroRV6jK4cuCZGmgIwFrCbSVGLqJm4NYS7FJNZ0dEMSWcFHwKaUM2_5N_9dvAImsxr6vQ';
    const LICENSE_KEY = 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NTc0NjIzOTksImp0aSI6IjA1ZmI5Y2MyLTY4ODQtNDRmNy1iMTE2LTBkNmE2NmIwNGNlNCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjBhOTgzNjViIn0.dtwzSrYwN6oqlMs-pOfcZUpBkLGlnB6BTvgTHL5KOwC8nEXEYevBOV77SUxlKQrztcYmTZLVQqJaqW2x325YOQ';
    const CKBOX_TOKEN_URL = '';

    const {
        ClassicEditor,
        Autoformat,
        Bold,
        Italic,
        Underline,
        BlockQuote,
        Base64UploadAdapter,
        CloudServices,
        CKBox,
        Essentials,
        Heading,
        Image,
        ImageCaption,
        ImageResize,
        ImageStyle,
        ImageToolbar,
        ImageUpload,
        PictureEditing,
        Indent,
        IndentBlock,
        Link,
        List,
        MediaEmbed,
        Mention,
        Paragraph,
        PasteFromOffice,
        Table,
        TableColumnResize,
        TableToolbar,
        TextTransformation
    } = CKEDITOR;

    const { FormatPainter, SlashCommand } = CKEDITOR_PREMIUM_FEATURES;


    // import 'ckeditor5/ckeditor5.css';
    // import 'ckeditor5-premium-features/ckeditor5-premium-features.css';

    ClassicEditor.create(
            document.querySelector('#content'), {        
                language: "{{ session_has('locale') ? session('locale') : 'en'}}",
                plugins: [
                    Autoformat,
                    BlockQuote,
                    Bold,
                    CloudServices,
                    Essentials,
                    Heading,
                    Image,
                    ImageCaption,
                    ImageResize,
                    ImageStyle,
                    ImageToolbar,
                    ImageUpload,
                    Base64UploadAdapter,
                    Indent,
                    IndentBlock,
                    Italic,
                    Link,
                    List,
                    MediaEmbed,
                    Mention,
                    Paragraph,
                    PasteFromOffice,
                    PictureEditing,
                    Table,
                    TableColumnResize,
                    TableToolbar,
                    TextTransformation,
                    Underline,

                    // Include CKBox plugin only if the CKBOX_TOKEN_URL is provided.
                    ...(CKBOX_TOKEN_URL ? [
                        CKBox
                    ] : []),

                    // Include premium features only if the license key is not GPL.
                    ...(LICENSE_KEY !== 'GPL' ? [
                        SlashCommand
                    ] : [])
                ],
                licenseKey: LICENSE_KEY,
                toolbar: [
                    'undo',
                    'redo',
                    '|',
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    '|',
                    'link',
                    'uploadImage',
                    'ckbox',
                    'insertTable',
                    'blockQuote',
                    'mediaEmbed',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'outdent',
                    'indent'
                ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        }
                    ]
                },
                image: {
                    resizeOptions: [{
                            name: 'resizeImage:original',
                            label: 'Default image width',
                            value: null
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50% page width',
                            value: '50'
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75% page width',
                            value: '75'
                        }
                    ],
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        '|',
                        'imageStyle:inline',
                        'imageStyle:wrapText',
                        'imageStyle:breakText',
                        '|',
                        'resizeImage'
                    ]
                },
                link: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://'
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                ckbox: {
                    tokenUrl: CKBOX_TOKEN_URL
                }
            }
        )
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error.stack);
        });
</script>

<?php
view('admin.layouts.footer');
