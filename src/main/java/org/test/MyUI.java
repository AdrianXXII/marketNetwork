package org.test;

import javax.servlet.annotation.WebServlet;

import com.vaadin.annotations.Theme;
import com.vaadin.annotations.VaadinServletConfiguration;
import com.vaadin.data.util.BeanItemContainer;
import com.vaadin.server.FontAwesome;
import com.vaadin.server.VaadinRequest;
import com.vaadin.server.VaadinServlet;
import com.vaadin.ui.*;
import com.vaadin.ui.themes.ValoTheme;

import java.util.List;

/**
 * This UI is the application entry point. A UI may either represent a browser window 
 * (or tab) or some part of a html page where a Vaadin application is embedded.
 * <p>
 * The UI is initialized using {@link #init(VaadinRequest)}. This method is intended to be 
 * overridden to add component to the user interface and initialize non-component functionality.
 */
@Theme("mytheme")
public class MyUI extends UI {

    private MemberService service = MemberService.getInstance();
    private Grid grid = new Grid();
    private Label titleLable = new Label("Adressverwaltung");
    private TextField filterText = new TextField();
    private Button clearFilterTextBtn = new Button(FontAwesome.TIMES);
    private MemberForm form = new MemberForm(this);

    @Override
    protected void init(VaadinRequest vaadinRequest) {
        VerticalLayout layout = new VerticalLayout();

        filterText.setInputPrompt("Nach Namen filtern");
        filterText.addTextChangeListener(e -> {
            grid.setContainerDataSource(new BeanItemContainer<>(Member.class,
                    service.findAll(e.getText())));
        });

        clearFilterTextBtn.addClickListener(e -> {
            filterText.clear();
            updateList();
        });

        HorizontalLayout title = new HorizontalLayout();
        title.setStyleName(ValoTheme.LABEL_H1);
        title.addComponent(titleLable);

        CssLayout filtering = new CssLayout();
        filtering.setStyleName(ValoTheme.LAYOUT_COMPONENT_GROUP);
        filtering.addComponents(filterText, clearFilterTextBtn);

        Button addMemberBtn = new Button("Neuen Kunden erstellen");
        addMemberBtn.addClickListener(e -> {
            grid.select(null);
            form.setMember(new Member());
        });

        HorizontalLayout toolbar = new HorizontalLayout(filtering, addMemberBtn);
        toolbar.setSpacing(true);

        grid.setColumns("firstName", "lastName", "email", "type");
        grid.getColumn("firstName").setHeaderCaption("Vorname");
        grid.getColumn("lastName").setHeaderCaption("Nachname");
        grid.getColumn("email").setHeaderCaption("Email");
        grid.getColumn("type").setHeaderCaption("Typ");

        HorizontalLayout main = new HorizontalLayout(grid, form);
        main.setSpacing(true);
        main.setSizeFull();
        grid.setSizeFull();
        main.setExpandRatio(grid, 1);

        layout.addComponents(title, toolbar, main);

        updateList();

        layout.setMargin(true);
        layout.setSpacing(true);
        setContent(layout);

        form.setVisible(false);

        grid.addSelectionListener(event -> {
            if (event.getSelected().isEmpty()){
                form.setVisible(false);
            }
            else{
                Member member = (Member) event.getSelected().iterator().next();
                form.setMember(member);
            }
        });
    }

    public void updateList(){
        List<Member> members = service.findAll();
        grid.setContainerDataSource(new BeanItemContainer<>(Member.class, members));
    }

    @WebServlet(urlPatterns = "/*", name = "MyUIServlet", asyncSupported = true)
    @VaadinServletConfiguration(ui = MyUI.class, productionMode = false)
    public static class MyUIServlet extends VaadinServlet {
    }
}
