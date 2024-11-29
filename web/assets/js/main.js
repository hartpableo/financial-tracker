(() => {
  const formFieldsContainer = document.querySelectorAll('.js-form-repeater-fields');

  if (!formFieldsContainer) {
    return;
  }

  formFieldsContainer.forEach((container) => {
    initAddItemFeature(container);
  })

  function initAddItemFeature(target) {
    const addItemButton = target.closest('form').querySelector('.js-add-item');
    const itemType = addItemButton.dataset.itemType;
    addItemButton.addEventListener('click', handleAddItem(target, itemType));
  }

  function handleAddItem(container, itemType) {
    const itemsCount = getItemsCount(container);
    appendNewInput(itemsCount, itemType, container);
  }

  // Function to count items dynamically
  function getItemsCount(container) {
    return container.querySelectorAll('[data-slot="field-wrapper"]').length;
  }

  // Append new input component
  function appendNewInput(itemsCount, itemType, container) {
    const newInputComponent = createInputComponent(itemsCount + 1, itemType);
    container.insertAdjacentHTML('beforeend', newInputComponent);
  }

  // Create input component HTML
  function createInputComponent(index, itemType) {
    const type = itemType === 'asset' ? 'assets' : 'liabilities';
    return `<div class="mb-3 d-flex justify-content-start align-items-stretch" data-slot="field-wrapper">
                <input
                  type="text" 
                  name="${type}[${index}][title]"
                  id="${itemType}-item-${index}"
                  class="form-control" 
                  aria-label="${itemType.charAt(0).toUpperCase() + itemType.slice(1)} Item ${index}"
                >
                <input aria-label="Amount" type="text" placeholder="Amount" name="${type}[${index}][amount]">
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

  formFieldsContainer.forEach((container) => {
    observer.observe(container, { childList: true });
  })

})();
