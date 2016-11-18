// Adapted from https://github.com/javierjulio/textarea-autosize/blob/master/src/jquery.textarea_autosize.js

function containsText(value) {
    return (value.replace(/\s/g, '').length > 0);
}

function get_padding(el) {
    return parseInt(window.getComputedStyle(el, null).getPropertyValue('padding-bottom'))
        + parseInt(window.getComputedStyle(el, null).getPropertyValue('padding-top'))
        + parseInt(window.getComputedStyle(el, null).getPropertyValue('border-top-width'))
        + parseInt(window.getComputedStyle(el, null).getPropertyValue('border-bottom-width'))
        || 0;
}

function set_height(el) {
    let currentScroll = el.scrollTop;
    el.style.height   = '0px';
    el.style.height   = (el.scrollHeight - get_padding(el)) + 'px';
    el.scrollTop      = currentScroll;
}

export default {

    bind(el) {

        el.addEventListener('input', function (event) {
            set_height(event.target);
        });

        el.addEventListener('keyup', function (event) {
            set_height(event.target);
        });

    },

    componentUpdated(el) {
        if (containsText(el.value)) {
            set_height(el);
        }
    }

}