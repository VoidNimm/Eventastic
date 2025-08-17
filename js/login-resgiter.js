// Ambil data user yang sudah login dari localStorage
const loggedInUser = JSON.parse(localStorage.getItem("loggedInUser"));
const authButton = document.getElementById("authButton");

if (loggedInUser) {
  // Jika user sudah login, ubah tombol menjadi Logout
  authButton.innerText = "Logout";
  authButton.href = "#";

  authButton.addEventListener("click", function () {
    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out of your account.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, logout!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        localStorage.removeItem("loggedInUser"); // Hapus session
        Swal.fire({
          title: "Logged Out",
          text: "You have been logged out successfully.",
          icon: "success",
          timer: 2000,
          showConfirmButton: false,
        }).then(() => {
          window.location.href = "login.html"; // Redirect ke halaman login setelah logout
        });
      }
    });
  });
}
