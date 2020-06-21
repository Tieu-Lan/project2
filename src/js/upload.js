var
    fileInput = document.getElementById('test-image-file'),
    info = document.getElementById('test-file-info'),
    preview = document.getElementById('test-image-preview');
info.innerHTML = '未选择图片';
fileInput.addEventListener('change', function () {
    preview.style.backgroundImage = '';
    if (!fileInput.value) {
        info.innerHTML = '未选择图片';
        return;
    }else {
        info.innerHTML = '';
    }
    var file = fileInput.files[0];
    if (file.type !== 'image/jpeg' && file.type !== 'image/png' && file.type !== 'image/gif' && file.type !== 'image/jpg') {
        alert('不是有效的图片文件!');
        return;
    }
    var reader = new FileReader();
    reader.onload = function (e) {
        var
            data = e.target.result;
        preview.style.backgroundImage = 'url(' + data + ')';
    };
    reader.readAsDataURL(file);
});