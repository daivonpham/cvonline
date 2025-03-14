$(document).ready(function () {
  // Sử dụng event delegation để xử lý các phần tử động
  $(document).on("click", ".dropdown-btn", function (e) {
    e.stopPropagation();
    // Toggle dropdown của button được click
    $(this).siblings(".nested-dropdown").toggle();
  });

  $(document).on("click", ".menu-item-final", function (e) {
    e.stopPropagation();
    const selectedValue = $(this).text();
    const dataValue = $(this).data("value");
    // Tìm dropdown container cha gần nhất
    const container = $(this).closest(".dropdown-container");
    // Cập nhật text và value trong container đó
    container.find(".dropdown-btn").text(selectedValue);
    container.find('input[type="hidden"]').val(dataValue);
    container.find(".nested-dropdown").hide();
  });

  $(document).click(function (e) {
    if (!$(e.target).closest(".dropdown-container").length) {
      $(".nested-dropdown").hide();
    }
  });

  $(document).on("click", ".nested-dropdown", function (e) {
    e.stopPropagation();
  });
});

// Hàm thêm và xóa
// tham số 1 = id nút thêm
// tham số 2 = id form
// tham số 3 = class bút xóa
function addForm(buttonId, formId, removeButtonClass) {
  document.getElementById(buttonId).addEventListener("click", function () {
    var form = document.getElementById(formId);
    var newForm = form.cloneNode(true);

    newForm.querySelectorAll("input").forEach(function (input) {
      input.value = "";
    });

    var dropdownBtn = newForm.querySelector(".dropdown-btn");
    if (dropdownBtn) {
      dropdownBtn.textContent = "Chọn chuyên ngành";
    }
    var hiddenInput = newForm.querySelector('input[type="hidden"]');
    if (hiddenInput) {
      hiddenInput.value = "";
    }
    var removeButton = newForm.querySelector(`.${removeButtonClass}`);
    removeButton.setAttribute("onclick", 'removeForm(this, "' + formId + '")');

    form.parentNode.appendChild(newForm);
  });
}
function removeForm(button, formId) {
  var formToRemove = button.closest(`#${formId}`);
  formToRemove.remove();
}

document.addEventListener("DOMContentLoaded", function () {
  const dropdownBtn = document.getElementById("language-btn");
  const dropdownMenu = document.querySelector(".nested-dropdown-lang");
  const selectedContainer = document.getElementById("selected-languages");
  const languageInput = document.getElementById("language"); // Lấy input ẩn

  // Khởi tạo mảng để lưu các ngôn ngữ đã chọn
  let selectedLanguages = [];

  // Gán giá trị ban đầu từ input ẩn (nếu có)
  if (languageInput.value) {
    selectedLanguages = languageInput.value
      .split(",")
      .map((lang) => lang.trim());
    selectedLanguages.forEach((lang) => {
      const selectedLang = document.createElement("span");
      selectedLang.classList.add("selected-lang");
      selectedLang.setAttribute("data-value", lang);
      selectedLang.innerHTML = `${lang} <span class="remove-lang">×</span>`;
      selectedContainer.appendChild(selectedLang);

      // Xử lý xóa ngôn ngữ
      selectedLang
        .querySelector(".remove-lang")
        .addEventListener("click", function () {
          selectedLang.remove();
          selectedLanguages = selectedLanguages.filter((l) => l !== lang);
          updateLanguageInput(); // Cập nhật input ẩn khi xóa
        });
    });
  }

  dropdownBtn.addEventListener("click", function () {
    dropdownMenu.classList.toggle("show");
  });

  document.querySelectorAll(".menu-item-final-lang").forEach((item) => {
    item.addEventListener("click", function () {
      const langName = this.getAttribute("data-value"); // Lấy tên đầy đủ (ví dụ: "Tiếng Nhật")

      // Kiểm tra nếu đã tồn tại thì không thêm lại
      if (selectedLanguages.includes(langName)) return;

      // Thêm ngôn ngữ vào mảng
      selectedLanguages.push(langName);

      // Tạo phần tử mới hiển thị ngôn ngữ đã chọn
      const selectedLang = document.createElement("span");
      selectedLang.classList.add("selected-lang");
      selectedLang.setAttribute("data-value", langName);
      selectedLang.innerHTML = `${langName} <span class="remove-lang">×</span>`;

      selectedContainer.appendChild(selectedLang);

      // Xóa ngôn ngữ khi bấm dấu "×"
      selectedLang
        .querySelector(".remove-lang")
        .addEventListener("click", function () {
          selectedLang.remove();
          selectedLanguages = selectedLanguages.filter((l) => l !== langName);
          updateLanguageInput(); // Cập nhật input ẩn khi xóa
        });

      // Cập nhật input ẩn với tất cả ngôn ngữ đã chọn
      updateLanguageInput();

      // Ẩn dropdown sau khi chọn
      dropdownMenu.classList.remove("show");
    });
  });

  // Hàm cập nhật giá trị của input ẩn language[]
  function updateLanguageInput() {
    languageInput.value = selectedLanguages.join(","); // Gán các ngôn ngữ thành chuỗi cách nhau bởi dấu phẩy
  }

  // Đóng dropdown khi click bên ngoài
  document.addEventListener("click", function (e) {
    if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.remove("show");
    }
  });
});


// học vấn
addForm("add-education", "education-form", "btn-education");

// kinh nghiệm làm việc
addForm("add-experientce-work", "experientce-work-form", "btn-experientce");

// kỹ năng
addForm("add-skill", "skill-form", "btn-skill");

// dự án
addForm("add-project", "project-form", "btn-project");

// danh hiệu và giải thưởng
addForm("add-award", "award-form", "btn-award");

// hoạt động
addForm("add-activity", "activity-form", "btn-activity");

// chứng chỉ
addForm("add-certificate", "certificate-form", "btn-certificate");

// sở thích
addForm("add-hobies", "hobies-form", "btn-hobies");

// sở thích
addForm("add-language", "language-form", "btn-language");

