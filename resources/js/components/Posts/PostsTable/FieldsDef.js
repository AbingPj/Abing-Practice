import VuetableFieldSwitch from "./VuetableFieldSwitch.vue";
import VuetableFieldButtons from "./VuetableFieldButtons.vue";

export default [
    {
        name: "id",
        title: "ID",
        sortField: "id"
    },
    {
        name: "image",
        title: "Image",
        titleClass: "text-center",
        dataClass: "text-center",
        formatter(value) {
            let image = '<img src="' + value + '" alt height="70" width="100">';
            return image;
        }
    },
    {
        name: "title",
        title: "Title",
        sortField: "title"
    },
    {
        name: "description",
        title: "Description"
    },
    {
        name: "submitted_by",
        title: "Submitted By",
        sortField: "submitted_by"
    },
    {
        name: VuetableFieldSwitch,
        title: "Toggle Switch",
        titleClass: "text-center",
        dataClass: "text-center",
        switch: {
            // label: "Male?",
            label: data => data.title,
            field: data => data.gender === "M"
        }
    },
    {
        name: VuetableFieldButtons,
        title: "Button Actions",
        titleClass: "text-center",
        dataClass: "text-center"
    }
];
