elgg.action('do_math', {
  data: {
    arg1: 1224,
    arg2: 10
  },
  success: function (wrapper) {
    if (wrapper.output) {
      alert(wrapper.output.sum);
      alert(wrapper.output.product);
    } else {
      // the system prevented the action from running
    }
  }
});