package org.test;

import com.vaadin.data.fieldgroup.BeanFieldGroup;
import com.vaadin.event.ShortcutAction;
import com.vaadin.ui.*;
import com.vaadin.ui.themes.ValoTheme;

/**
 * Created by reto on 05.02.17.
 */
public class CustomerForm extends FormLayout{

    private TextField firstName = new TextField("Vorname");
    private TextField lastName = new TextField("Nachname");
    private TextField email = new TextField("E-Mail");
    private NativeSelect type = new NativeSelect("Typ");
    private PopupDateField abo_start = new PopupDateField("Abo gestartet");
    private Button save = new Button("Speichern");
    private Button delete = new Button("Löschen");

    private CustomerService service = CustomerService.getInstance();
    private Customer customer;
    private MyUI myUI;

    public CustomerForm(MyUI myUI){
        this.myUI = myUI;

        type.addItems(CustomerType.values());

        save.setStyleName(ValoTheme.BUTTON_PRIMARY);
        save.setClickShortcut(ShortcutAction.KeyCode.ENTER);

        save.addClickListener(e -> save());
        delete.addClickListener(e -> delete());

        setSizeUndefined();
        HorizontalLayout buttons = new HorizontalLayout(save, delete);
        buttons.setSpacing(true);
        addComponents(firstName, lastName, email, type, abo_start, buttons);


    }

    public void setCustomer(Customer customer){
        this.customer = customer;
        BeanFieldGroup.bindFieldsUnbuffered(customer, this);

        delete.setVisible(customer.isPersisted());
        setVisible(true);
        firstName.selectAll();
    }

    private void save(){
        service.save(customer);
        myUI.updateList();
        setVisible(false);
    }

    private void delete(){
        service.delete(customer);
        myUI.updateList();
        setVisible(false);
    }
}
