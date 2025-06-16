function toggleComponent() {
  return {
    show: false,
    toggle() {
      this.show = !this.show;
      console.log(`Toggle state is now: ${this.show ? "ON" : "OFF"}`);
    },
  };
}
