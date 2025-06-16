function toggleComponent() {
  return {
    show: false,
    toggle() {
      this.show = !this.show;
    },
  };
}
