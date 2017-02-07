package org.test;

import com.sun.javafx.scene.layout.region.Margins;
import com.vaadin.data.fieldgroup.BeanFieldGroup;
import com.vaadin.event.ShortcutAction;
import com.vaadin.ui.*;
import com.vaadin.ui.themes.ValoTheme;

/**
 * Created by reto on 05.02.17.
 */
public class MemberForm extends FormLayout{

    /* Definitionen für den Edit-Bereich des Members */

    private TextField firstName = new TextField("Vorname");
    private TextField lastName = new TextField("Nachname");
    private TextField street = new TextField("Strasse");
    private TextField zip = new TextField("Postleitzahl");
    private TextField city = new TextField("Stadt");
    private TextField email = new TextField("E-Mail");
    private TextField tel = new TextField("Telefon");

    private NativeSelect type = new NativeSelect("Typ");
    private CheckBox trialperiode = new CheckBox("Provisorisches Mitglied");
    private PopupDateField abo_start = new PopupDateField("Abo gestartet");
    private Button save = new Button("Speichern");
    private Button delete = new Button("Löschen");

    private MemberService service = MemberService.getInstance();
    private Member member;
    private MyUI myUI;

    public MemberForm(MyUI myUI){
        this.myUI = myUI;

        type.addItems(MemberType.values());

        save.setStyleName(ValoTheme.BUTTON_PRIMARY);
        save.setClickShortcut(ShortcutAction.KeyCode.ENTER);

        save.addClickListener(e -> save());
        delete.addClickListener(e -> delete());

        setSizeUndefined();

        HorizontalLayout name = new HorizontalLayout(firstName, lastName);
        HorizontalLayout address2 = new HorizontalLayout(zip, city);
        HorizontalLayout contact = new HorizontalLayout(email, tel);
        HorizontalLayout customerInfo = new HorizontalLayout(type, trialperiode);
        HorizontalLayout buttons = new HorizontalLayout(save, delete);

        name.setSpacing(true);
        address2.setSpacing(true);
        contact.setSpacing(true);
        customerInfo.setSpacing(true);
        buttons.setSpacing(true);
        addComponents(name, street, address2, contact, customerInfo, abo_start, buttons);
    }

    public void setMember(Member member){
        this.member = member;
        BeanFieldGroup.bindFieldsUnbuffered(member, this);

        delete.setVisible(member.isPersisted());
        setVisible(true);
        firstName.selectAll();
    }

    private void save(){
        service.save(member);
        myUI.updateList();
        setVisible(false);
    }

    private void delete(){
        service.delete(member);
        myUI.updateList();
        setVisible(false);
    }
}
