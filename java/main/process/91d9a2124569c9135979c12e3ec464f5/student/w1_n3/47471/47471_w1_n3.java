package comproweek3;

import java.util.Scanner;

/**
 *
 * @author thanawatgualti
 */
public class Ex5 {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        int ans;
        int all = 0 ;
        System.out.println("++++++++++++++++++++++++++++++++++++++++++++++++++++++");
        System.out.println("\t \t  VANDING MACHINE \t \t");
        System.out.println("++++++++++++++++++++++++++++++++++++++++++++++++++++++");
        while (true) {
            System.out.print("Welcome vending machine Enter 1-Sandwich, 2-Cake, 3-Beverage: ");
            int value = input.nextInt();
            if (value == 1) {
                System.out.print("Enter 1-Tuna (30), 2- Hamburger (40) , 3- Ham (35): ");
                int sandwich = input.nextInt();
                switch (sandwich) {
                    case 1 : all = all + 30;
                    break;
                    case 2 : all = all + 40;
                    break;
                    case 3 : all = all + 35;
                    break;
                    default: System.out.println("Error");
                    break;
                }
            } else if (value == 2) {
                System.out.print("Enter 1-Donut (15), 2-JamRoll (15) , 3-Pastry (25), 4-Cookie(10) : ");
                int cake = input.nextInt();
                switch (cake) {
                    case 1 : all = all + 35;
                    break;
                    case 2 : all = all + 15;
                    break;
                    case 3 : all = all + 25;
                    break;
                    case 4 : all = all + 105;
                    break;
                    default: System.out.println("Error");
                    break;
                }
            } else if (value == 3) {
                System.out.print("Enter 1-Coke (15), 2- Est (15) , 3-Greentea (60) : ");
                int beverage = input.nextInt();
                switch (beverage) {
                    case 1 : all = all + 15;
                    break;
                    case 2 : all = all + 15;
                    break;
                    case 3 : all = all + 60;
                    break;
                    default: System.out.println("Error");
                    break;
                }
            }
            System.out.print("Do you want to continue: ");
            char choose = input.next().charAt(0);
            if (choose == 'Y') {
            } else {
                break;
            }
        }
        System.out.println("++++++++++++++++++++++++++++++++++++++++++++++++++++++");
        System.out.format("\tThank You Very Much. The Price is: %d Baht \t",all);
        System.out.println("\n++++++++++++++++++++++++++++++++++++++++++++++++++++++");
    }
}
