function initRichText() {
    tinymce.init({
        selector: '#descriptionExperience',
        max_chars: "1000",
        branding: false,
        contextmenu: false,
        menu: {
            custom: { title: 'Custom Menu', items: 'undo redo ' },
            format: { title: 'Format', items: 'bold italic  underline  | forecolor backcolor' }
        },
        menubar: '',
        plugins: 'lists,textcolor autolink link paste',
        toolbar: 'undo redo |  bold italic underline | alignleft aligncenter alignright alignjustify |numlist bullist| forecolor backcolor| link ',
        link_default_protocol: 'https',
        lists_indent_on_tab: false
    });
    tinymce.init({
        selector: '#skillDes',
        max_chars: "1000",
        branding: false,
        contextmenu: false,
        menu: {
            custom: { title: 'Custom Menu', items: 'undo redo ' },
            format: { title: 'Format', items: 'bold italic  underline  | forecolor backcolor' }
        },
        menubar: '',
        plugins: 'lists,textcolor autolink link paste',
        toolbar: 'undo redo |  bold italic underline | alignleft aligncenter alignright alignjustify |numlist bullist| forecolor backcolor| link ',
        link_default_protocol: 'https',
        lists_indent_on_tab: false
    });
    tinymce.init({
        selector: '#descriptionEdu',
        max_chars: "1000",
        branding: false,
        contextmenu: false,
        menu: {
            custom: { title: 'Custom Menu', items: 'undo redo ' },
            format: { title: 'Format', items: 'bold italic  underline  | forecolor backcolor' }
        },
        menubar: '',
        plugins: 'lists,textcolor autolink link paste',
        toolbar: 'undo redo |  bold italic underline | alignleft aligncenter alignright alignjustify |numlist bullist| forecolor backcolor| link ',
        link_default_protocol: 'https',
        lists_indent_on_tab: false
    });
}

initRichText();
