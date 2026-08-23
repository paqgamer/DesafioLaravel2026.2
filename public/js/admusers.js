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

window.onclick = function (event) {
    const modal = document.getElementById("editUserModal");
    if (event.target === modal) {
        closeEditModal();
    }
};


document.getElementById("edit_photo").addEventListener("change", function (event) {
    const preview = document.getElementById("edit_photo_preview");
    const clearBtn = document.getElementById("edit_photo_clear");
    const file = event.target.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
        clearBtn.style.display = "block";
    } else {
        const original = preview.dataset.original || "";
        preview.src = original;
        preview.style.display = original ? "block" : "none";
        clearBtn.style.display = "none";
    }
});

document.getElementById("edit_photo_clear").addEventListener("click", function () {
    const input = document.getElementById("edit_photo");
    const preview = document.getElementById("edit_photo_preview");
    const original = preview.dataset.original || "";

    input.value = "";
    preview.src = original;
    preview.style.display = original ? "block" : "none";
    this.style.display = "none";
});


document.getElementById("edit_cep").addEventListener("input", function (event) {
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

            document.getElementById("edit_street").value = data.logradouro || "";
            document.getElementById("edit_neighborhood").value = data.bairro || "";
            document.getElementById("edit_city").value = data.localidade || "";
            document.getElementById("edit_state").value = data.uf || "";

        })
        .catch(() => {
            alert("O cep não pode ser consultado, favor aguarde ou  preencha tudo manualmente.");
        });
});