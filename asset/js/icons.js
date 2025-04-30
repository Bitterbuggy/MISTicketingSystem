function insertTemplate(id, templateId) {
const target = document.getElementById(id);
const template = document.getElementById(templateId);
const clone = template.content.cloneNode(true);
target.appendChild(clone);
}

document.addEventListener('DOMContentLoaded', () => {
insertTemplate('completed-icon', 'completed-icon-template');
insertTemplate('total-icon', 'total-icon-template');
});