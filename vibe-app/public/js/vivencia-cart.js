(function () {
  const CART_KEY = 'vivenciaCart';

  window.vivenciaCartStore = {
    read() {
      try {
        return JSON.parse(localStorage.getItem(CART_KEY) || '{}');
      } catch (error) {
        return {};
      }
    },
    write(cart) {
      localStorage.setItem(CART_KEY, JSON.stringify(cart || {}));
    },
    clear() {
      localStorage.removeItem(CART_KEY);
    },
    asItems(cart) {
      return Object.entries(cart || {}).map(([name, item]) => ({
        name,
        price: Number(item.price || 0),
        quantity: Number(item.quantity || 0),
      })).filter((item) => item.quantity > 0);
    },
  };
})();
