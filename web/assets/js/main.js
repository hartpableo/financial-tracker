(() => {
  const formFieldsContainer = document.querySelector('.js-form-repeater-fields');

  function initAddItemFeature(target) {
    const addItemButton = target.closest('form').querySelector('.js-add-item');
    addItemButton.addEventListener('click', handleAddItem);
  }

  initAddItemFeature(formFieldsContainer);

  function handleAddItem() {
    const itemsCount = getItemsCount();
    appendNewInput(itemsCount);
  }

  // Function to count items dynamically
  function getItemsCount() {
    return formFieldsContainer.querySelectorAll('[data-slot="field-wrapper"]').length;
  }

  // Append new input component
  function appendNewInput(itemsCount) {
    const newInputComponent = createInputComponent(itemsCount + 1);
    formFieldsContainer.insertAdjacentHTML('beforeend', newInputComponent);
  }

  // Create input component HTML
  function createInputComponent(index) {
    return `<div class="mb-3 d-flex justify-content-start align-items-stretch" data-slot="field-wrapper">
                <input
                  type="text" 
                  name="assets[${index}][title]"
                  id="asset-item-${index}" 
                  class="form-control" 
                  aria-label="Asset Item ${index}"
                  placeholder="Asset ${index}"
                >
                <input aria-label="Amount" type="text" placeholder="Amount" name="assets[${index}][amount]">
                <button type="button" aria-label="Remove item ${index}" class="js-remove-item fw-bold text-danger">X</button>
            </div>`;
  }

  // Delegate remove item functionality
  document.addEventListener('click', (e) => {
    if (e.target.matches('.js-remove-item')) {
      e.target.closest('[data-slot="field-wrapper"]').remove();
    }
  });

  // Observe container for added nodes
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        if (node.nodeType === Node.ELEMENT_NODE && node.querySelector('.js-remove-item')) {
          node.querySelector('.js-remove-item').addEventListener('click', (e) => {
            e.target.closest('[data-slot="field-wrapper"]').remove();
          });
        }
      });
    });
  });

  observer.observe(formFieldsContainer, {childList: true});

})();
