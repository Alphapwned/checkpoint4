/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

/* Import TinyMCE */
import tinymce from "tinymce";

/* Import the skin */
import "tinymce/skins/ui/oxide/skin.css";

/* Import plugins */
import "tinymce/plugins/advlist";
import "tinymce/plugins/code";
import "tinymce/plugins/emoticons";
import "tinymce/plugins/emoticons/js/emojis";
import "tinymce/plugins/fullscreen";
import "tinymce/plugins/image";
import "tinymce/plugins/link";
import "tinymce/plugins/lists";
import "tinymce/plugins/table";
import "tinymce-lang/langs/fr_FR";

import "tinymce/themes/silver";
import "tinymce/models/dom";
import "tinymce/icons/default";

/* Import content css */
import "tinymce/skins/ui/oxide/content.css";
import "tinymce/skins/content/default/content.css";

/* Initialize TinyMCE */
tinymce.init({
    selector: "textarea",
    language: "en_EN",
    plugins: "advlist code link lists table fullscreen image",
    toolbar:
        "fullscreen undo redo | forecolor fontsize bold italic underline | bullist numlist | link image | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify",
    menubar: false,
    content_css: false,
    toolbar_mode: "wrap",
});
