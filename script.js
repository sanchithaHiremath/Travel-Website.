document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("menuToggle");
  const nav = document.getElementById("mainNav");
  if (toggle && nav) {
    toggle.addEventListener("click", () => nav.classList.toggle("open"));
    nav.querySelectorAll("a").forEach(link => link.addEventListener("click", () => nav.classList.remove("open")));
  }

  const people = document.getElementById("people");
  const unitPrice = document.getElementById("unitPrice");
  const totalPrice = document.getElementById("totalPrice");
  const peopleCount = document.getElementById("peopleCount");
  function updateTotal() {
    if (!people || !unitPrice || !totalPrice) return;
    const count = Number(people.value || 1);
    const price = Number(unitPrice.dataset.price || 0);
    if (peopleCount) peopleCount.textContent = count;
    totalPrice.textContent = "$" + (price * count).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2});
  }
  if (people) { people.addEventListener("change", updateTotal); updateTotal(); }

  const dateInput = document.getElementById("travelDate");
  if (dateInput) {
    const today = new Date();
    const localToday = new Date(today.getTime() - today.getTimezoneOffset() * 60000).toISOString().slice(0, 10);
    dateInput.min = localToday;
  }

  const backToTop = document.getElementById("backToTop");
  if (backToTop) {
    const updateTopButton = () => { backToTop.style.display = window.scrollY > 350 ? "block" : "none"; };
    window.addEventListener("scroll", updateTopButton);
    updateTopButton();
    backToTop.addEventListener("click", () => window.scrollTo({top: 0, behavior: "smooth"}));
  }
});
