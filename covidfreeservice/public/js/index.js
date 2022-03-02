function showHide(Element) {
    nextElement = Element.nextElementSibling;
    if (nextElement.style.display != 'block') {
        nextElement.style.display = 'block';
    } else {
        nextElement.style.display = 'none';
    }
}
