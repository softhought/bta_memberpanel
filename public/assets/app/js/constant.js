const BASEURL = $("#base_url").val() + "/" + $("#slug").val();
const lottieAnimations = {};

function blockUI(id = 'global', containerId = 'lottie-global') {
    $('#global-tab-loader').css('background', 'rgba(255, 255, 255, 0.8)');

    if (!lottieAnimations[id]) {
        lottieAnimations[id] = lottie.loadAnimation({
            container: document.getElementById(containerId),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/assets/anim/loading.json'
        });
    }
}

function unblockUI() {
    $('#global-tab-loader').hide();
}