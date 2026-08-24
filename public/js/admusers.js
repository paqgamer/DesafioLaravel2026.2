// O JS poode ser um pouco duro as vezes
// javascript can  be a little harsh sometimes
// JavaScript kann manchmal etwas hart sein
// JavaScript interdum aliquantulum asperum esse potest.
// JavaScript порой бывает довольно суров.
// JavaScriptは、時に少し厄介なことがあります。


function openEditModal(usuario) {
    const form = document.getElementById("editUserForm");
    form.action = `/admin/users/${usuario.id}`;

    document.getElementById("edit_name").value = usuario.name || "";
    document.getElementById("edit_email").value = usuario.email || "";
    document.getElementById("edit_cpf").value = usuario.cpf || "";
    document.getElementById("edit_saldo").value = usuario.saldo || 0;
    document.getElementById("edit_phone").value = usuario.phone || "";
    document.getElementById("edit_birth_date").value = usuario.birth_date || "";
    document.getElementById("edit_cep").value = usuario.cep || "";
    document.getElementById("edit_state").value = usuario.state || "";
    document.getElementById("edit_street").value = usuario.street || "";
    document.getElementById("edit_number").value = usuario.number || "";
    document.getElementById("edit_neighborhood").value = usuario.neighborhood || "";
    document.getElementById("edit_city").value = usuario.city || "";
    document.getElementById("edit_complement").value = usuario.complement || "";

    const isAdminCheckbox = document.getElementById("edit_is_admin");
    const isAdminHint = document.getElementById("edit_is_admin_hint");
    const isSelf = usuario.id === window.currentUserId;

    isAdminCheckbox.checked = !!usuario.is_admin;
    isAdminCheckbox.dataset.self = isSelf ? "1" : "0";
    isAdminHint.style.display = isSelf ? "block" : "none";

    const preview = document.getElementById("edit_photo_preview");
    const originalPhotoUrl = usuario.photo ? `/storage/${usuario.photo}` : "";
    preview.src = originalPhotoUrl;
    preview.style.display = originalPhotoUrl ? "block" : "none";
    preview.dataset.original = originalPhotoUrl;

    document.getElementById("edit_photo").value = "";
    document.getElementById("edit_photo_clear").style.display = "none";

    document.getElementById("editUserModal").style.display = "flex";
}

function closeEditModal() {
    document.getElementById("editUserModal").style.display = "none";
}

function openCreateModal() {
    document.getElementById("createUserForm").reset();

    const preview = document.getElementById("create_photo_preview");
    preview.src = "";
    preview.style.display = "none";
    document.getElementById("create_photo_clear").style.display = "none";

    document.getElementById("createUserModal").style.display = "flex";
}

function closeCreateModal() {
    document.getElementById("createUserModal").style.display = "none";
}

window.onclick = function (event) {
    if (event.target === document.getElementById("editUserModal")) {
        closeEditModal();
    }
    if (event.target === document.getElementById("createUserModal")) {
        closeCreateModal();
    }
};


function setupImagePreview(inputId, previewId, clearBtnId, getOriginalUrl) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const clearBtn = document.getElementById(clearBtnId);

    input.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
            clearBtn.style.display = "block";
        } else {
            const original = getOriginalUrl();
            preview.src = original;
            preview.style.display = original ? "block" : "none";
            clearBtn.style.display = "none";
        }
    });

    clearBtn.addEventListener("click", function () {
        input.value = "";
        const original = getOriginalUrl();
        preview.src = original;
        preview.style.display = original ? "block" : "none";
        this.style.display = "none";
    });
}


function setupCepAutofill(prefix) {
    document.getElementById(`${prefix}cep`).addEventListener("input", function (event) {
        const cepLimpo = event.target.value.replace(/\D/g, "");

        if (cepLimpo.length !== 8) {
            return;
        }

        fetch(`/api/cep/${cepLimpo}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.erro) {
                    alert(data.mensagem || "CEP não encontrado.");
                    return;
                }

                document.getElementById(`${prefix}street`).value = data.logradouro || "";
                document.getElementById(`${prefix}neighborhood`).value = data.bairro || "";
                document.getElementById(`${prefix}city`).value = data.localidade || "";
                document.getElementById(`${prefix}state`).value = data.uf || "";

            })
            .catch(() => {
                alert("Não foi possível consultar o CEP agora. Tente novamente.");
            });
    });
}

setupImagePreview(
    "edit_photo",
    "edit_photo_preview",
    "edit_photo_clear",
    () => document.getElementById("edit_photo_preview").dataset.original || ""
);

setupImagePreview(
    "create_photo",
    "create_photo_preview",
    "create_photo_clear",
    () => "" 
);

setupCepAutofill("edit_");
setupCepAutofill("create_");


document.getElementById("edit_is_admin").addEventListener("change", function () {
    if (this.dataset.self === "1" && ! this.checked) {
        this.checked = true;
    }
});