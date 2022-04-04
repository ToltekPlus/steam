export function redirect(path) {
  if (path) {
    window.setTimeout(function () {
      window.location = path;
    }, 2000);
  }
}
