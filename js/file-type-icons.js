(function ($) {
    Drupal.behaviors.exposedfilter_hijack = {
        attach: function () {
            /*
             Hovering icons for various types of documents.
             This detects the document in a tags and applies an icon per doc type.
             */
            var document_types = [
                "pdf",
                "doc",
                "docx",
                "pptx",
                "ppt"
            ];

            for (var i = 0; i < document_types.length; i++) {
                $(".region.region-content a[href*='." + document_types[i] + "']").each(function () {
                    $(this).addClass(" document_icon document_" + document_types[i]);
                });
            }

            function link_is_external(link_element) {
                var hostLocation = location.host;
                return (link_element.host !== hostLocation)
            }

            $('.region.region-content a').each(function() {
                if ($(this).attr('href') != null) {
                    if ($(this).attr('href').indexOf("@") == -1) {
                        if (link_is_external(this)) {
                            $(this).addClass(" document_icon external_link").attr('target', '_blank');
                        }
                    }
                }
            });
        }
    };
})(jQuery);