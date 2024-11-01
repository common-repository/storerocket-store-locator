(function () {
    tinymce.PluginManager.add("wpStoreRocket", function (editor, url) {
        editor.addButton("wpStoreRocket", {
            title: "Insert StoreRocket Store Locator",
            cmd: "wpStoreRocket",
            image: storerocket_base_url + "assets/img/storerocket_icon.png",
            onClick: function (e) {
                editor.insertContent("[wp-storerocket]");
            }
        });
    });
})();