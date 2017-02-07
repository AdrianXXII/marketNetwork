package org.test;

/**
 * Created by reto on 05.02.17.
 */

import java.io.Serializable;
import java.util.Date;

/**
 * A entity object, like in any other Java application. In a typical real world
 * application this could for example be a JPA entity.
 */
@SuppressWarnings("serial")
public class Member implements Serializable, Cloneable {

    private Long id;

    private String firstName = "";

    private String lastName = "";

    private String street = "";

    private String zip = "";

    private String city = "";

    private String email = "";

    private String tel = "";

    private Boolean trialperiode;

    private Date abo_start;

    private Integer abo_id;

    private MemberType type;

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    /**
     * Get the value of email
     *
     * @return the value of email
     */
    public String getEmail() {
        return email;
    }

    /**
     * Set the value of email
     *
     * @param email
     *            new value of email
     */
    public void setEmail(String email) {
        this.email = email;
    }

    /**
     * Get the value of abo_start
     *
     * @return the value of abo_start
     */
    public Date getBirthDate() {
        return abo_start;
    }

    /**
     * Set the value of birthDate
     *
     * @param abo_start
     *            new value of birthDate
     */
    public void setBirthDate(Date abo_start) {
        this.abo_start = abo_start;
    }

    /**
     * Get the value of lastName
     *
     * @return the value of lastName
     */
    public String getLastName() {
        return lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param lastName
     *            new value of lastName
     */
    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    /**
     * Get the value of firstName
     *
     * @return the value of firstName
     */
    public String getFirstName() {
        return firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param firstName
     *            new value of firstName
     */
    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    /**
     * Get the value of street
     *
     * @return the value of street
     */
    public String getStreet() {
        return street;
    }

    /**
     * Set the value of street
     *
     * @param street
     *            new value of street
     */
    public void setStreet(String street) {
        this.street = street;
    }

    public String getZip() {
        return zip;
    }

    public void setZip(String zip) {
        this.zip = zip;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getTel() {
        return tel;
    }

    public void setTel(String tel) {
        this.tel = tel;
    }

    public Boolean getTrialperiode() {
        return trialperiode;
    }

    public void setTrialperiode(Boolean trialperiode) {
        this.trialperiode = trialperiode;
    }

    public Date getAbo_start() {
        return abo_start;
    }

    public void setAbo_start(Date abo_start) {
        this.abo_start = abo_start;
    }

    public Integer getAbo_id() {
        return abo_id;
    }

    public void setAbo_id(Integer abo_id) {
        this.abo_id = abo_id;
    }

    public MemberType getType() {
        return type;
    }

    public void setType(MemberType type) {
        this.type = type;
    }


    public boolean isPersisted() {
        return id != null;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (this.id == null) {
            return false;
        }

        if (obj instanceof Member && obj.getClass().equals(getClass())) {
            return this.id.equals(((Member) obj).id);
        }

        return false;
    }

    @Override
    public int hashCode() {
        int hash = 5;
        hash = 43 * hash + (id == null ? 0 : id.hashCode());
        return hash;
    }

    @Override
    public Member clone() throws CloneNotSupportedException {
        return (Member) super.clone();
    }

    @Override
    public String toString() {
        return firstName + " " + lastName;
    }
}