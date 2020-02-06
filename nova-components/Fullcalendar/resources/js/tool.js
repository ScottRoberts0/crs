Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: "fullcalendar",
            path: "/calendar",
            component: require("./components/Tool")
        }
    ]);
});
