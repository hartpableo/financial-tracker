(($) => {
  const $addItemButton = $('.js-add-item');
  $addItemButton.on('click', (e) => {
    const $this = $(e.currentTarget);
    const currentLength = getItemsLength($this);
    appendNewInput($this, currentLength);
  });

  function getItemsLength(element) {
    return element.closest('form').find('.js-form-repeater-fields').find('input[name="assets[]"]').length;
  }

  function appendNewInput(element, itemsLength) {
    const $inputComponent = createInputComponent(itemsLength);
    const $form = element.closest('form').find('.js-form-repeater-fields');
    $form.append($inputComponent);
  }

  function createInputComponent(itemsLength) {
    const itemIndex = itemsLength + 1;
    return `<div class="mb-3 d-flex justify-content-start align-items-stretch">
                <input
                  type="text" 
                  name="assets[${itemIndex}][title]"
                  id="asset-item-${itemIndex}" 
                  class="form-control" 
                  aria-label="Asset Item ${itemIndex}"
                  placeholder="Asset ${itemIndex}"
                >
                <input aria-label="Amount" type="text" placeholder="Amount" name="assets[${itemIndex}][amount]">
            </div>`;
  }


})(jQuery)

function removeItem(index) {
  jQuery(`[data-item="${index}"]`).closest('[data-slot="field-wrapper"]').remove();
}